<?php
ob_start();
include './variaveis.php';
$sql_create_table = "CREATE TABLE IF NOT EXISTS Tudor_eletiva(  
      nome_aluno varchar(255),
      nome_eletiva varchar(255),
      serie varchar(255),
      ra int,
      primary key(ra)
  )default charset utf8;";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Aluno | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-LG.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

    <style>
    /* Estilos do pop-up */
    #sobreposicao-popup {
        display: none;
        /* Inicialmente oculto */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    #conteudo-popup {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    #fechar-popup {
        border: none;
        width: 82px;
        height: 40px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        background-color: #007bff;
        font-size: 20px;
    }

    button:hover {
        cursor: pointer;
    }

    input[type='submit'] {
        cursor: pointer;
    }


    footer {
        margin-top: 130px;
        padding: 10px;
        background-color: #161616;
        text-align: center;
        color: white;
    }


    .nomes-grupos {
        display: flex;
        justify-content: center;
        margin-top: 16px;
    }

    .vertical {
        height: 200px;
        border-left: 2px solid;
    }

    .back {
        width: 200px;

    }

    .front {
        width: 200px;

    }

    .bd {
        width: 200px;

    }

    .creditos {
        margin-bottom: 10px;
    }

    .creditos p {
        margin-bottom: 1px;
    }

    .informacoes-escola p {
        margin-bottom: 7px;
    }

    .instagram-links {
        display: flex;
        margin: 0 auto;
        width: 190px;

    }

    .tecnico-sala {
        display: flex;
        flex-direction: row;
        align-items: center;
        text-align: center;
        width: 100px;

    }

    .escola-insta {
        display: flex;
        flex-direction: row;
        align-items: center;
        text-align: center;
        width: 90px;

    }

    .informacoes-escola img {
        width: 20px;
        margin: 0 5px;
    }

    .informacoes-escola a {
        text-decoration: none;
        color: #919191;
        margin: 0 5px;
    }

    .linha-horizontal {
        border: 1px solid #ccc;
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <header class="header-bg">
        <div class="header">
            <img src="img/Imagem3.png" alt="Brazão do Nossa Senhora de Lourdeso" class="brazao">
            <div class="barra">
                <ul class="header-menu">
                    <a href="gestor.php">
                        <li>Gestor</li>
                    </a>
                    <a href="professor.php">
                        <li>Professor</li>
                    </a>
                </ul>
            </div>
        </div>
    </header>

    <main class="main-bg">
        <div class="main-caixa">

            <h1 class="main-login">LOGIN</h1>

            <form action="" class="main-form" method="post">
                <label for="" class="main-label">
                    Ra:
                    <input type="text" class="main-input" name="RA" placeholder="00000-00" required>

                    <img src="img/icons8-lock-30.png" alt="">
                </label>

                <input type="submit" value="Entrar" name="enviar" class="botao">
            </form>
        </div>
    </main>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Ocorreu um erro</h2>
            <p>Infelizmente não encontramos nenhum <br> aluno com esse RA</p>
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
  if (isset($_POST['enviar'])) {
    $RA = $_POST['RA'];
    $conn = new mysqli($host, $user, $password, $db_dados);
    $sql_create_table = "CREATE TABLE IF NOT EXISTS Tudor_eletiva(  
          nome_aluno varchar(255),
          nome_eletiva varchar(255),
          serie varchar(255),
          ra int,
          primary key(ra)
      )default charset utf8;";
    if ($conn->query($sql_create_table) === TRUE) {

      $sql_select = "SELECT nomes, turmas ,curso FROM alunos WHERE ra = ?";
      $stmt = $conn->prepare($sql_select);
      $stmt->bind_param("s", $RA);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $nome = $row['nomes'];
        $serie = $row['turmas'];
        $curso_tec = $row['curso'];

        $url = "Tutoria-eletiva.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie) . "&curso_tec=" . urlencode($curso_tec);
        header("location: $url");
        ob_end_flush();

        exit;
      } else {
        echo "<script> mostrarPopup() </script>";
      }
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