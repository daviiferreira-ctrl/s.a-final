<?php
require "conexao.php";

$nome   = $_POST['nome'];
$senha  = $_POST['senha'];
$email  = "";





// 1. CORREÇÃO: Verifica se o NOME de usuário já está cadastrado (e não o e-mail)
$sql_check = "SELECT id_usuario FROM usuario WHERE nome = :nome";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->bindValue(":nome", $nome);
$stmt_check->execute();

if ($stmt_check->rowCount() > 0) {
    echo "<script>alert('Erro: Este nome de usuário já está cadastrado!'); window.history.back();</script>";
    exit();
}

// 2. CORREÇÃO: Insere gravando o nome na coluna 'nome' e preenche um e-mail padrão fictício
$sql = "INSERT INTO usuario (nome, email, senha, permissao_funcao) 
        VALUES (:nome, :email, :senha, 'cliente')";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":email", $nome . "@vetket.com"); // Gera um e-mail automático para não quebrar o banco
$stmt->bindValue(":senha", $senha);
$stmt->execute();

echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'login.php';</script>";

?>