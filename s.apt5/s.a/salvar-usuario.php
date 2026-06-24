<?php
require "conexao.php";

$nome   = $_POST['nome'];
$senha  = $_POST['senha'];
$email  = "";





// 1. Verifica se o e-mail já está cadastrado na tabela de usuários
$sql_check = "SELECT id_usuario FROM usuario WHERE email = :email";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->bindValue(":email", $email);
$stmt_check->execute();

if ($stmt_check->rowCount() > 0) {
    echo "<script>alert('Erro: Este e-mail já está cadastrado!'); window.history.back();</script>";
    exit();
}

// 2. Insere na tabela correta 'usuario' com os campos do modelo lógico
$sql = "INSERT INTO usuario (nome, email, senha, permissao_funcao) 
        VALUES (:nome, :email, :senha, 'cliente')";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":senha", $senha); // Recomenda-se usar password_hash no futuro
$stmt->execute();

echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'login.php';</script>";

?>