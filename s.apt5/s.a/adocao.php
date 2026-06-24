<?php
require "conexao.php";

$sql_adotados = "SELECT descricao FROM consulta WHERE descricao IS NOT NULL";
$stmt = $pdo->query($sql_adotados);
$adotados = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>VetKet - Adoção</title>
    <link rel="stylesheet" href="css/stylecopy.css">
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">Nossa clínica Vetket</div>
            <ul class="menu">
                <li><a href="base.html">Início</a></li>
                <li><a href="agendamento.php">Agendamento</a></li>
                <li><a href="listar.php">Consultas</a></li>
                <li><a href="adocao.php">Adotar</a></li>
                <li><a href="sobre.html">Sobre</a></li>
                <li><a href="login.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="adocao-grid">

            <!-- 1. Pipoca -->
            <?php if (!in_array('Pipoca', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/cachorro.jpg" alt="Foto do Cachorro">
                    <span class="pet-especie">Cachorro</span>
                </div>
                <div class="pet-info">
                    <h3>Pipoca</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 2 anos</p>
                        <p><strong>Saúde:</strong> <span class="badge">Excelente</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Pipoca" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 2. Bolinha -->
            <?php if (!in_array('Bolinha', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/cachorro2.jpg" alt="Foto do Cachorro">
                    <span class="pet-especie">Cachorro</span>
                </div>
                <div class="pet-info">
                    <h3>Bolinha</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 5 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Vacinado / Saudável</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Bolinha" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 3. Pompom -->
            <?php if (!in_array('Pompom', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/coelho.jpg" alt="Foto do Coelho">
                    <span class="pet-especie">Coelho</span>
                </div>
                <div class="pet-info">
                    <h3>Pompom</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 1 ano</p>
                        <p><strong>Saúde:</strong> <span class="badge">Excelente</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Pompom" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 4. Mel -->
            <?php if (!in_array('Mel', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/gato.jpg" alt="Foto do Gato">
                    <span class="pet-especie">Gato</span>
                </div>
                <div class="pet-info">
                    <h3>Mel</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 3 anos</p>
                        <p><strong>Saúde:</strong> <span class="badge">Excelente</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Mel" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 5. Thor -->
            <?php if (!in_array('Thor', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/gato2.webp" alt="Foto de Gato">
                    <span class="pet-especie">Gato</span>
                </div>
                <div class="pet-info">
                    <h3>Thor</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 1 ano e 4 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Vacinado</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Thor" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 6. Algodão -->
            <?php if (!in_array('Algodão', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/gato3.jpg" alt="Foto de Gato">
                    <span class="pet-especie">Gato</span>
                </div>
                <div class="pet-info">
                    <h3>Algodão</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 5 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Excelente</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Algodão" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 7. Rex (NOVO) -->
            <?php if (!in_array('Max', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/cachorromax.jpg" alt="Foto do Cachorro">
                    <span class="pet-especie">Cachorro</span>
                </div>
                <div class="pet-info">
                    <h3>Max</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 3 anos</p>
                        <p><strong>Saúde:</strong> <span class="badge">Pulgas</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Rex" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 8. Luna (NOVO) -->
            <?php if (!in_array('Luna', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/gatolupin.jpg" alt="Foto do Gato">
                    <span class="pet-especie">Gato</span>
                </div>
                <div class="pet-info">
                    <h3>Luna</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 1 ano</p>
                        <p><strong>Saúde:</strong> <span class="badge">Castrada</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Luna" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 9. Fred (NOVO) -->
            <?php if (!in_array('Fred', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/porquinho-da-india.jpg" alt="Foto do Cachorro">
                    <span class="pet-especie">Porquinho-da-índia </span>
                </div>
                <div class="pet-info">
                    <h3>Fred</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 8 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Vacinado</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Fred" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

            <!-- 10. Mia (NOVO) -->
            <?php if (!in_array('Mia', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/cachorro4.webp" alt="Foto do cachorro">
                    <span class="pet-especie">Cachorro</span>
                </div>
                <div class="pet-info">
                    <h3>Mia</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 2 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Vacinado</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Mia" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

             <!-- 10. Luns (NOVO) -->
            <?php if (!in_array('Mia', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/luna.jpg" alt="Foto do Gato">
                    <span class="pet-especie">Gato</span>
                </div>
                <div class="pet-info">
                    <h3>Luna</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 1 ano</p>
                        <p><strong>Saúde:</strong> <span class="badge">Excelente</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Mia" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>


            <!-- 11. Floquinho (NOVO) -->
            <?php if (!in_array('Floquinho', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/coelhobob.png" alt="Foto do Coelho">
                    <span class="pet-especie">Coelho</span>
                </div>
                <div class="pet-info">
                    <h3>Floquinho</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 6 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Saudável</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Floquinho" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

             <!-- 11. Flor teste (NOVO) -->
            <?php if (!in_array('teste', $adotados)) { ?>
            <div class="pet-card">
                <div class="pet-image">
                    <img src="img/coelhobob.png" alt="Foto do Coelho">
                    <span class="pet-especie">teste</span>
                </div>
                <div class="pet-info">
                    <h3>TESTE</h3>
                    <div class="pet-detalhes">
                        <p><strong>Idade:</strong> 6 meses</p>
                        <p><strong>Saúde:</strong> <span class="badge">Saudável</span></p>
                    </div>
                    <a href="processo-adocao.php?nome=Floquinho" class="btn-adotar">Quero Adotar</a>
                </div>
            </div>
            <?php } ?>

       
            <footer>
        <p><br><br><br><br>
            &copy; 2026 VetKet - Todos os direitos reservados.</p>
    </footer>

</body>