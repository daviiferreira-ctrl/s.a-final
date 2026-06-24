<<?php
// Pega o nome do pet que veio do link lá de trás (Ex: Bolinha)
$nome_pet = $_GET['nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Termo de Responsabilidade</title>
    <link rel="stylesheet" href="css/stylecopy.css">
</head>
<body>



    <main class="container">
        <div class="login-container" style="width: 100%; max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 8px;">
            <h2>Termo de Responsabilidade de Adoção</h2>
            <p>Preencha seus dados para finalizar a adoção do(a) <strong><?php echo $nome_pet; ?></strong>.</p>
            <br>

            <form method="POST" action="salvar-adocao.php">

                <input type="hidden" name="nome_pet" value="<?php echo $nome_pet; ?>">

                <label for="nome_completo">Seu Nome Completo:</label>
                <input type="text" name="nome_completo" id="nome_completo" placeholder="Digite seu nome completo" required>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required>

                <label for="telefone">Telefone para Contato:</label>
                <input type="text" name="telefone" id="telefone" placeholder="(00) 00000-0000" required>

         
                <button type="submit" class="btn-adotar" style="width: 100%; margin-top: 20px;">Quero Adotar</button>
                
                <div style="text-align: center; margin-top: 15px;">
                    <a href="adocao.php" style="color: #ff6b6b; text-decoration: none; font-weight: bold;">Cancelar</a>
                </div>
            </form>

        </div>
    </main>

</body>
</html>
