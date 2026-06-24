<?php
require "conexao.php";

$nome_pet       = $_POST['nome_pet'];
$nome_completo  = $_POST['nome_completo'];
$cpf            = $_POST['cpf'];
$telefone       = $_POST['telefone'];

$data_hoje  = date('Y-m-d');
$hora_agora = date('H:i:s');


$sql_vet_automatico = "SELECT id_vet FROM veterinario LIMIT 1";
$stmt_vet_automatico = $pdo->query($sql_vet_automatico);
$vet_encontrado = $stmt_vet_automatico->fetch(PDO::FETCH_ASSOC);

// Se achar um veterinário usa o ID dele, senão usa 1 como fallback de segurança
$id_vet_valido = $vet_encontrado ? $vet_encontrado['id_vet'] : 1;


$sql_busca_pet = "SELECT id_animal FROM animal WHERE nome = '$nome_pet'";
$stmt_busca_pet = $pdo->query($sql_busca_pet);
$pet_encontrado = $stmt_busca_pet->fetch(PDO::FETCH_ASSOC);

if ($pet_encontrado) {
    $id_animal_valido = $pet_encontrado['id_animal'];
} else {
    $id_ani_res = $pdo->query("SELECT COALESCE(MAX(id_animal), 0) AS max_id FROM animal")->fetch();
    $id_animal_valido = $id_ani_res['max_id'] + 1;
    
    $sql_ins_pet = "INSERT INTO animal (id_animal, id_responsavel, especie, nome) VALUES ('$id_animal_valido', 1, 'Pet Adoção', '$nome_pet')";
    $pdo->query($sql_ins_pet);
}


$id_con_res = $pdo->query("SELECT COALESCE(MAX(id_consulta), 0) AS max_id FROM consulta")->fetch();
$id_consulta_novo = $id_con_res['max_id'] + 1;


// 🛠️ AJUSTADO: Agora envia o $id_vet_valido correto para o MySQL aceitar a gravação e salvar o nome do Pompom na 'descricao'
$sql = "INSERT INTO consulta (id_consulta, id_animal, id_vet, dataa, hora, locall, descricao) 
        VALUES ('$id_consulta_novo', '$id_animal_valido', '$id_vet_valido', '$data_hoje', '$hora_agora', 'Adotado por: $nome_completo', '$nome_pet')";
$pdo->query($sql);

echo "<script>
        alert('Parabéns! Você adotou o pet " . $nome_pet . " com sucesso!'); 
        window.location.href = 'adocao.php';
      </script>";
?>
