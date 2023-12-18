<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

    <link rel="stylesheet" href="css/botao.css">
    <link rel="stylesheet" href="css/header-PFR.css">
    <link rel="stylesheet" href="css/style-ELT.css">
    <style>
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
    <?php
  $RA = $_GET['RA'];
  $serie = $_GET['serie'];
  $nome = $_GET['nome'];
  $curso_tec = $_GET['curso_tec'];
  ?>


    <header class="header-bg">
        <div class="header">
            <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
            <div class="header-menu">
                <a href="#" class="nome">
                    <?php echo $nome ."<br>" .$serie;?>
                    <br>
                </a>
                <img class="user" src="img/Imagem1.svg" alt="User">
            </div>
        </div>
    </header>

    <main class="main-bg">
        <div class="main-caixa">

            <form action="" method="post">
                <button type="submit" name="eletiva" Class="animated-button1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    ELETIVA
                </button>
            </form>
            <form action="" method="post">
                <button type="submit" name="tutoria" class="animated-button1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    TUTORIA
                </button>
            </form>
        </div>
    </main>

    <?php 
    if(isset($_POST["eletiva"])){
      $url = "eletiva.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie)  . "&curso_tec=" . urlencode($curso_tec);
      header("location: $url");
    }

    if(isset($_POST["tutoria"])){
      $url = "tutoria.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie);
      header("location: $url");
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