<?php
require "conexao.php";

$tem_coluna_foto = true;
    try {
        $sql = "SELECT c.data, c.hora, c.local, c.descricao, p.especie, p.foto_pet, u.nome AS responsavel_nome, v.nome AS veterinario_nome
                FROM consulta c
                LEFT JOIN pet p ON c.id_pet = p.id_pet
                LEFT JOIN usuario u ON c.id_usuario = u.id_usuario
                LEFT JOIN veterinario v ON c.id_vet = v.id_vet
                ORDER BY c.data DESC, c.hora DESC";
        $stmt = $pdo->query($sql);
        $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $tem_coluna_foto = false;
        $sql = "SELECT c.data, c.hora, c.local, c.descricao, p.especie, u.nome AS responsavel_nome, v.nome AS veterinario_nome
                FROM consulta c
                LEFT JOIN pet p ON c.id_pet = p.id_pet
                LEFT JOIN usuario u ON c.id_usuario = u.id_usuario
                LEFT JOIN veterinario v ON c.id_vet = v.id_vet
                ORDER BY c.data DESC, c.hora DESC";
        $stmt = $pdo->query($sql);
        $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>VetKet - Consultas Agendadas</title>
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
        <section style="width: 100%; box-sizing: border-box; padding: 0 20px;">
            <h2 style="text-align: center; margin-bottom: 30px; color: #5cb3a0;">Consultas Agendadas</h2>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <!-- Aplicando as classes do CSS para definir as proporções de cada coluna -->
                        <th class="col-data">Data</th>
                        <th class="col-horario">Horário</th>
                        <th class="col-pet">Pet (Espécie)</th>
                        <th class="col-responsavel">Responsável</th>
                        <th class="col-local">Local</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $con) { 
                        $especie_texto = $con['especie'];
                        $foto_nome = $tem_coluna_foto ? $con['foto_pet'] : null;
                        $caminho_final = null;

                        if (empty($foto_nome) && strpos($con['especie'], '(') !== false) {
                            $partes_inicio = explode('(', $con['especie']);
                            $especie_texto = trim($partes_inicio[0]); 
                            $foto_nome = trim(str_replace(')', '', $partes_inicio[1])); 
                        }

                        if (!empty($foto_nome)) {
                            if (file_exists("uploads/" . $foto_nome)) {
                                $caminho_final = "uploads/" . $foto_nome;
                            } elseif (file_exists("img/" . $foto_nome)) {
                                $caminho_final = "img/" . $foto_nome;
                            }
                        }
                    ?>
                                                <tr>
                            <!-- Linha 88 corrigida de 'dataa' para 'data' -->
                            <td class="col-data"><?php echo date('d/m', strtotime($con['data'])); ?></td>
                            <td class="col-horario"><?php echo date('H:i', strtotime($con['hora'])); ?></td>
                            <td class="col-pet">
                                <div class="pet-mini-container">
                                    <?php if ($caminho_final !== null) { ?>
                                        <img src="<?php echo $caminho_final; ?>" class="pet-foto-renderizada" alt="Foto do Pet">
                                    <?php } else { ?>
                                        <span class="pet-foto-placeholder">🐾</span>
                                    <?php } ?>
                                    
                                    <!-- Linha 98 corrigida: Removido o 'nome_pet' que não existe no banco -->
                                    <span><?php echo "(" . $especie_texto . ")"; ?></span>
                                </div>
                            </td>
                            <td class="col-responsavel"><?php echo $con['responsavel_nome']; ?></td>
                            <!-- Linha 102 corrigida de 'locall' para 'local' -->
                            <td class="col-local"><?php echo $con['local']; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 VetKet - Todos os direitos reservados.</p>
    </footer>

</body>
</html>
