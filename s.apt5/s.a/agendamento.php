<?php
require_once "conexao.php";

$sql_vets = "SELECT id_vet, nome, especialidade FROM veterinario ORDER BY nome ASC";
$stmt_vets = $pdo->query($sql_vets);
$veterinarios = $stmt_vets->fetchAll(PDO::FETCH_ASSOC);

$sql_vet_automatico = "SELECT id_vet FROM veterinario LIMIT 1";
$stmt_vet_automatico = $pdo->query($sql_vet_automatico);
$vet_encontrado = $stmt_vet_automatico->fetch(PDO::FETCH_ASSOC);

$id_vet_padrao = $vet_encontrado ? $vet_encontrado['id_vet'] : 1;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>VetKet - Agendamento</title>
    <link rel="stylesheet" href="css/stylecopy.css">
    <style>
        /* Estrutura Flexbox para colar o footer na base da página */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fcf9f2; /* Fundo creme do seu layout */
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        /* O main cresce e empurra o footer para o final da página */
        main.container {
            flex: 1 0 auto;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Caixa branca do formulário corrigida e alargada */
        .agendamento-card {
            width: 100%;
            max-width: 600px; /* Largura perfeita para respirar na tela */
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        .agendamento-card h2 {
            color: #2b3e51;
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
            font-size: 24px;
        }

        /* Faz os labels pularem linha e terem destaque */
        .agendamento-card label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        /* Inputs corrigidos ocupando 100% da largura horizontal */
        .agendamento-card input[type="text"],
        .agendamento-card input[type="email"],
        .agendamento-card input[type="date"],
        .agendamento-card input[type="time"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            background-color: #f8fafc;
            box-sizing: border-box; /* Impede o input de estourar a lateral */
            transition: border-color 0.2s;
        }

        .agendamento-card input:focus {
            outline: none;
            border-color: #a3d2ca; /* Verde-água no foco */
            background-color: #ffffff;
        }

        /* File input */
        .agendamento-card input[type="file"] {
            width: 100%;
            box-sizing: border-box;
            padding: 5px 0;
        }

        /* Caixa de Preview da Imagem */
        .preview {
            width: 100%;
            height: 160px;
            border: 2px dashed #cbd5e1;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            color: #64748b;
            border-radius: 8px;
            overflow: hidden;
        }
        .preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Alinhamento lado a lado para Data e Hora */
        .form-row-tempo {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }
        .form-group-tempo {
            flex: 1;
        }

        /* Botão estilizado com a paleta da clínica */
        .btn-agendar {
            margin-top: 30px;
            width: 100%;
            padding: 14px;
            background-color: #a3d2ca; /* Verde-água idêntico ao topo */
            color: #2b3e51;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-agendar:hover {
            background-color: #8cbab2;
        }

        /* Rodapé fixado e estilizado */
        footer {
            flex-shrink: 0;
            background-color: #1e293b;
            color: #ffffff;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            border-top: 4px solid #a3d2ca;
        }
    </style>
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
        <!-- Substituído login-container por agendamento-card -->
        <div class="agendamento-card">
            <h2>Dados do agendamento</h2>

            <form method="POST" action="salvar-agendamento.php" enctype="multipart/form-data">
                
                <input type="hidden" name="id_vet" value="<?php echo $id_vet_padrao; ?>">
                <input type="hidden" name="locall" value="Clínica Principal">

                <label for="nome">Nome do Responsável:</label>
                <input type="text" name="nome" id="nome" required>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" required>

                <label for="pet_nome">Nome do Pet:</label>
                <input type="text" name="pet_nome" id="pet_nome" required>

                <label for="especie">Espécie:</label>
                <input type="text" name="especie" id="especie" placeholder="Ex: Cachorro, Gato" required>

                <label for="foto">Foto do Pet:</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
                
                <div class="preview" id="preview">
                    <span>Preview da imagem</span>
                </div>

                <div class="form-row-tempo">
                    <div class="form-group-tempo">
                        <label for="dataa">Data de agendamento:</label>
                        <input type="date" name="dataa" id="dataa" required>
                    </div>
                    <div class="form-group-tempo">
                        <label for="hora">Horário de agendamento:</label>
                        <input type="time" name="hora" id="hora" required>
                    </div>
                </div>

                <button type="submit" class="btn-agendar">Agendar</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 VetKet - Todos os direitos reservados.</p>
    </footer>

    <script>
        const foto = document.getElementById('foto');
        const preview = document.getElementById('preview');

        foto.addEventListener('change', function(){
            const arquivo = this.files[0];

            if(arquivo){
                const leitor = new FileReader();

                leitor.onload = function(e){
                    preview.innerHTML = `<img src="${e.target.result}">`;
                }

                leitor.readAsDataURL(arquivo);
            }
        });
    </script>

</body>
</html>
