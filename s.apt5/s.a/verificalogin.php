<?php
session_start();
require_once "conexao.php"; // arquivo da conexão PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    // CORREÇÃO: Alterado de 'email = :email' para 'nome = :nome'
    $sql = "SELECT * FROM usuario WHERE nome = :nome AND senha = :senha";

    $stmt = $pdo->prepare($sql);
    
    // CORREÇÃO: Passando o token ':nome' com o valor digitado pelo usuário
    $stmt->execute([
        ':nome' => $usuario,
        ':senha' => $senha
    ]);


    $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados_usuario) {
        // Como o SELECT já validou a senha na Query, basta logar o usuário
        $_SESSION['id_usuario'] = $dados_usuario['id_usuario']; // Atualizado para id_usuario
        $_SESSION['nome']       = $dados_usuario['nome'];
        $_SESSION['logado']     = true;

        header("Location: base.html");
        exit();
    } else {
        // Se não encontrar nenhuma combinação correta de email e senha
        header("Location: login.php?erro=usuario");
        exit();
    }
}
?>
<link rel="stylesheet" href="css/stylecopy.css">
