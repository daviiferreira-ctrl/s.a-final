<?php
require "conexao.php";

// Captura e limpa os dados do formulário
$nome     = trim($_POST['nome']);
$email    = trim($_POST['email']);
$telefone = trim($_POST['telefone']);
$especie  = trim($_POST['especie']);
$data     = $_POST['dataa']; // Converte o input name 'dataa' para a variável correta
$hora     = $_POST['hora'];
$local    = "Clínica Principal";

$nomeFoto = null;

// Upload da foto do pet
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $pasta = "uploads/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeFoto = uniqid() . "_" . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $pasta . $nomeFoto);
}

// 1. Checa se o horário da consulta já está ocupado
$sql_checa = "SELECT id_agendamento FROM consulta WHERE data = :data AND hora = :hora";
$stmt_checa = $pdo->prepare($sql_checa);
$stmt_checa->bindValue(":data", $data);
$stmt_checa->bindValue(":hora", $hora);
$stmt_checa->execute();

if ($stmt_checa->rowCount() > 0) {
    echo "<script>alert('Erro: Este dia e horário já estão ocupados!'); window.history.back();</script>";
    exit();
}

// 2. Localiza ou cadastra o Usuário (antigo responsável)
$sql_user = "SELECT id_usuario FROM usuario WHERE email = :email";
$stmt_user = $pdo->prepare($sql_user);
$stmt_user->bindValue(":email", $email);
$stmt_user->execute();
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $id_usuario = $user['id_usuario'];
} else {
    $sql_ins_user = "INSERT INTO usuario (nome, email, senha, permissao_funcao) VALUES (:nome, :email, '123456', 'cliente')";
    $stmt_ins_user = $pdo->prepare($sql_ins_user);
    $stmt_ins_user->bindValue(":nome", $nome);
    $stmt_ins_user->bindValue(":email", $email);
    $stmt_ins_user->execute();
    
    $id_usuario = $pdo->lastInsertId();
}

// 3. Salva o telefone vinculado ao Usuário
$sql_ins_tel = "INSERT INTO telefone (numero, id_usuario) VALUES (:numero, :id_usuario)";
$stmt_ins_tel = $pdo->prepare($sql_ins_tel);
$stmt_ins_tel->bindValue(":numero", $telefone);
$stmt_ins_tel->bindValue(":id_usuario", $id_usuario);
$stmt_ins_tel->execute();

// 4. Localiza se o usuário já tem um pet cadastrado com essa mesma espécie
$sql_checa_pet = "SELECT id_pet FROM pet WHERE id_usuario = :id_usuario AND especie = :especie";
$stmt_checa_pet = $pdo->prepare($sql_checa_pet);
$stmt_checa_pet->bindValue(":id_usuario", $id_usuario);
$stmt_checa_pet->bindValue(":especie", $especie);
$stmt_checa_pet->execute();
$pet_existente = $stmt_checa_pet->fetch(PDO::FETCH_ASSOC);

if ($pet_existente) {
    $id_pet = $pet_existente['id_pet'];
} else {
    // Cadastra o novo Pet caso não exista
    $sql_ins_pet = "INSERT INTO pet (id_usuario, especie, foto_pet) VALUES (:id_usuario, :especie, :foto_pet)";
    $stmt_ins_pet = $pdo->prepare($sql_ins_pet);
    $stmt_ins_pet->bindValue(":id_usuario", $id_usuario);
    $stmt_ins_pet->bindValue(":especie", $especie);
    $stmt_ins_pet->bindValue(":foto_pet", $nomeFoto);
    $stmt_ins_pet->execute();
    
    $id_pet = $pdo->lastInsertId();
}

// 5. Garante que exista o Veterinário padrão (ID 1) cadastrado na tabela veterinario
$pdo->query("INSERT IGNORE INTO veterinario (id_vet, nome, especialidade, hora_atendi, descricao) VALUES (1, 'Geral', 'Clínica Geral', '08:00:00', 'Atendimento geral')");

// 6. Insere o agendamento da Consulta com a estrutura correta
$sql_consulta = "INSERT INTO consulta (id_pet, id_vet, id_usuario, local, data, hora) 
                 VALUES (:id_pet, 1, :id_usuario, :local, :data, :hora)";
$stmt_consulta = $pdo->prepare($sql_consulta);
$stmt_consulta->bindValue(":id_pet", $id_pet);
$stmt_consulta->bindValue(":id_usuario", $id_usuario);
$stmt_consulta->bindValue(":local", $local);
$stmt_consulta->bindValue(":data", $data);
$stmt_consulta->bindValue(":hora", $hora);
$stmt_consulta->execute();

echo "<script>alert('Agendamento realizado com sucesso!'); window.location.href = 'listar.php';</script>";
?>
