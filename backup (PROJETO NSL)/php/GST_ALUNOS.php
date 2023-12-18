<?php 
include './variaveis.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-GST.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

</head>

<body>
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

    <div class="main-box">

        <h2 class="titulo">Inserção de Alunos</h2>
        <form class="formulario" action="" method="post">
            <label for="1-nome">Digite o nome do Aluno:</label>
            <input type="text" required name="nome">

            <label for="vagas">Digite o RA do aluno:</label>
            <input type="text" name="ra" required>



            <label for="serie">Selecione a série do aluno:</label>
            <select name="series" id="serie" required>
                <option value="1º01 HUMANAS">1º01 HUMANAS</option>
                <option value="1º01 ADM">1º01 ADM</option>
                <option value="1º02 ADM">1º02 ADM</option>
                <option value="1º01 INFORMÁTICA">1º01 INFORMÁTICA</option>
                <option value="2º01 HUMANAS">2º01 HUMANAS</option>
                <option value="2º01 ADM">2º01 ADM</option>
                <option value="2º01 INFORMÁTICA">2º01 INFORMÁTICA</option>
                <option value="2º02 INFORMÁTICA">2º02 INFORMÁTICA</option>
                <option value="3º01 HUMANAS">3º01 HUMANAS</option>
                <option value="3º01 ADM">3º01 ADM</option>
                <option value="3º02 ADM">3º02 ADM</option>
                <option value="3º01 INFORMÁTICA">3º01 INFORMÁTICA</option>
            </select>

            <label for="curso">Selecione o curso do aluno:</label>
            <select name="cursos" id="curso" required>
                <option value="INFORMATICA">INFOMÁRTICA</option>
                <option value="ADM">ADMINISTRAÇÃO</option>
                <option value="HUMANAS">HUMANAS</option>
            </select>

            <div class="btn-container">
                <input type="reset" class="btn-reset">
                <input type="submit" name="enviar" class="btn-submit">
            </div>
        </form>

    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Aluno inserido com <br> sucesso!</p>
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

    if (isset($_POST["enviar"])) {
        $nome = $_POST["nome"];
        $serie = $_POST["series"];
        $curso = $_POST["cursos"];
        $RA = $_POST["ra"];
 
        $conn = new mysqli($host, $user, $password, $db_dados);

        $sql = "INSERT INTO alunos (ra,turmas,nomes,curso) VALUES('$RA','$serie','$nome','$curso')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>mostrarPopup()</script>";
        }
    }
    ?>

    <footer>
        <div class="creditos">
            <p class="projeto-info">Projeto realizado pelos alunos de Altas Habilidades da escola "EEEM Nossa Senhora"
            </p>
            <p class="supervisao-info">Supervisionado pelos professores Alex Menezes & Vânia Alves</p>

            <div class="nomes-grupos">


                <div class="back">
                    <h4>Backend<br> desenvolvido por:</h4>
                    <p class="backend-info"> Gabriel <br>Cirqueira</p>
                </div>
                <div class="vertical"></div>

                <div class="bd">
                    <h4>Banco de dados <br>desenvolvido por:</h4>
                    <p class="bd-info"> Gabriel<br> Cirqueira &<br> Matheus <br>Trindade</p>

                </div>
                <div class="vertical"></div>

                <div class="front">
                    <h4>Frontend <br>desenvolvido por:</h4>
                    <p class="frontend-info"> Guilherme<br> Vagmaker & <br> Arthur <br> Possino</p>

                </div>
            </div>

        </div>
        <hr class="linha-horizontal">
        <div class="informacoes-escola">
            <p class="endereco-info">Endereço: 🏫 𝚁𝚞𝚊 𝚂𝚎𝚗. 𝙴𝚞𝚛𝚒𝚌𝚘 𝚁𝚎𝚣𝚎𝚗𝚍𝚎, 𝟹𝟸𝟶 - 𝙲𝚎𝚗𝚝𝚛𝚘<br>
                𝙿𝚒𝚗𝚑𝚎𝚒𝚛𝚘𝚜/𝙴𝚂</p>
            <p class="contato-info"> Contato: 📞 (𝟸𝟽) 99720-6728</p>
            <div class="instagram-links">

                <div class="tecnico-sala">
                    <img src="./img/logo_sala.png" alt="Logo Sala" class="logo-sala">
                    <a href="https://www.instagram.com/2.tecnico_nsl/" target="_blank" class="link-tecnico">Técnico</a>

                </div>
                <div class="escola-insta">
                    <img src="./img/instagram.png" alt="Instagram" class="logo-instagram">
                    <a href="https://www.instagram.com/nslescola/" target="_blank" class="link-escola">Escola</a>

                </div>

            </div>
        </div>
    </footer>

</body>

</html>