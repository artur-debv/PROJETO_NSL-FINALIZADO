<?php
// Inclui o arquivo de variáveis
include './variaveis.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Metadados do documento -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título e ícone da página -->
    <title>Gestor | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/style-GST.css">

    <!-- Fontes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

</head>

<body>

    <!-- Cabeçalho da página -->
    <header class="header-bg">
        <div class="header">
            <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
            <div class="header-menu">
                <a href="#" class="nome">
                    ADMINISTRADOR
                </a>
                <img class="user" src="img/Imagem1.svg" alt="User">
            </div>
        </div>
    </header>

    <!-- Formulário de inserção de Tutoria -->
    <div class="main-box-add">
        <h2 class="titulo">Inserção de Tutoria</h2>
        <form action="" method="post">

            <!-- Campos do formulário -->
            <label for="1-nome">Digite o nome do Profissional:</label>
            <input type="text" required id="1-nome" class="nomes" name="1prof">

            <label for="vagas">Informe a Função do profissional:</label>
            <input type="text" class="N-vagas" name="vagas" placeholder="Ex: professor, diretor...etc" required>

            <br><br>

            <!-- Botões de reset e submit -->
            <div class="botoes">
                <input type="reset">
                <input type="submit" name="enviar">
            </div>
        </form>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Tutoria inserida com <br> sucesso!</p>
            <button id="fechar-popup">Fechar</button>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
    const botaoFecharPopup = document.getElementById('fechar-popup');
    const sobreposicaoPopup = document.getElementById('sobreposicao-popup');

    function fecharPopup() {
        sobreposicaoPopup.style.display = 'none';
    }

    function mostrarPopup() {
        sobreposicaoPopup.style.display = 'block';
    }
    botaoFecharPopup.addEventListener('click', fecharPopup);
    </script>

    <?php
  // Verifica se o formulário foi enviado
  if (isset($_POST['enviar'])) {

    // Sanitiza e obtém os dados do formulário
    $professor_1 = str_replace(" ", "_", $_POST["1prof"]);
    $vagas = $_POST["vagas"];

    $conn = new mysqli($host, $user, $password, $db_tutoria);

    $sql = "CREATE TABLE IF NOT EXISTS $professor_1 (
            nome_tutor varchar(255),
            nome_aluno varchar(255),
            serie varchar(255),
            ra int,
            vagas int,
            primary key(ra)
        )default charset utf8;";

    if ($conn->query($sql) === TRUE) {
      echo "<script> mostrarPopup() </script>";
    }
  }
  ?>

    <!-- Rodapé da página -->
    <footer>
        <!-- Informações sobre o projeto -->
        <div class="creditos">
            <p class="projeto-info">Projeto realizado pelos alunos de Altas Habilidades da escola "EEEM Nossa Senhora"
            </p>
            <p class="supervisao-info">Supervisionado pelos professores Alex Menezes & Vânia Alves</p>

            <!-- Créditos individuais -->
            <div class="nomes-grupos">
                <!-- Backend -->
                <div class="back">
                    <h4>Backend<br> desenvolvido por:</h4>
                    <p class="backend-info"> Gabriel <br>Cirqueira</p>
                </div>
                <!-- Separador vertical -->
                <div class="vertical"></div>

                <!-- Banco de dados -->
                <div class="bd">
                    <h4>Banco de dados <br>desenvolvido por:</h4>
                    <p class="bd-info"> Gabriel<br> Cirqueira &<br> Matheus <br>Trindade</p>
                </div>
                <!-- Separador vertical -->
                <div class="vertical"></div>

                <!-- Frontend -->
                <div class="front">
                    <h4>Frontend <br>desenvolvido por:</h4>
                    <p class="frontend-info"> Guilherme<br> Vagmaker & <br> Arthur <br> Possino</p>
                </div>
            </div>
        </div>

        <!-- Linha horizontal -->
        <hr class="linha-horizontal">

        <!-- Informações da escola -->
        <div class="informacoes-escola">
            <p class="endereco-info">Endereço: 🏫 𝚁𝚞𝚊 𝚂𝚎𝚗. 𝙴𝚞𝚛𝚒𝚌𝚘 𝚁𝚎𝚣𝚎𝚗𝚍𝚎, 𝟹𝟸𝟶 - 𝙲𝚎𝚗𝚝𝚛𝚘<br>
                𝙿𝚒𝚗𝚑𝚎𝚒𝚛𝚘𝚜/𝙴𝚂</p>
            <p class="contato-info"> Contato: 📞 (𝟸𝟽) 99720-6728</p>

            <!-- Links do Instagram -->
            <div class="instagram-links">
                <!-- Técnico Sala -->
                <div class="tecnico-sala">
                    <img src="./img/logo_sala.png" alt="Logo Sala" class="logo-sala">
                    <a href="https://www.instagram.com/2.tecnico_nsl/" target="_blank" class="link-tecnico">Técnico</a>
                </div>
                <!-- Escola Instagram -->
                <div class="escola-insta">
                    <img src="./img/instagram.png" alt="Instagram" class="logo-instagram">
                    <a href="https://www.instagram.com/nslescola/" target="_blank" class="link-escola">Escola</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>