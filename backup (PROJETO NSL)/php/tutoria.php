<?php

include './variaveis.php';

$RA = $_GET['RA'];
$serie = $_GET['serie'];
$nome_aluno = $_GET['nome'];


$nometutor = "";



$conn = new mysqli($host, $user, $password, $db_tutoria);


$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row['Tables_in_' . $db_tutoria];
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.TUT.css">
    <title>Escolha Tutoria</title>

    <meta http-equiv="refresh" content="30">

    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <style>
    body {
        margin: 0px;
        padding: 0px;
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

    a {
        color: black;
        text-decoration: none;
        font-size: 18px;
        text-align: justify;
    }
    </style>
</head>

<body>
    <header class="header">
        <div class="brazao">
            <a href="../Tutoria-Eletiva.html"><img src="img/brazao.png" alt="Brazao" class="brazao"></a>
        </div>

        <div class="header-user">
            <a href="#" class="nome">
                <?php echo $nome_aluno . "<br>" . $serie; ?>

            </a>
            <img src="img/Imagem1.svg" alt="" class="user">
        </div>
    </header>
    <main class="tutor">

        <?php
 if ($result->num_rows != 0) {
        foreach ($tables as $table) {
            $sql = "SELECT MIN(vagas) AS vagas_disponiveis FROM $table ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($row["vagas_disponiveis"] == NULL) {
                $row["vagas_disponiveis"] = $vagas_tutoria;
            }
            $vagas[$table] = $row['vagas_disponiveis'];

            echo "
    <div class='tutores'>
        <img src='img/avatar.png' alt='' class=''>
        <span class='nome-tutor'>" . str_replace("_", " ", $table) . "<br>
            vagas:
            " . $vagas[$table] . "
        </span>
        <form action='' method='post'>
            <button type='submit' class='botao' name='tutores' value='escolher-" . $table . "' >Escolher</button>
        </form>
    </div>
 ";
        }
    }
    else {
        echo "  
    <div class='tutores'>
    <h1>SEM TUTOR!</h1> <br> 
<span>peça algum gestor para adicionar tutores </span>
</div> 
    ";
    }
        ?>


    </main>
    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">CONFIRMADO!</h2>
            <p>Você selecionou tutor com <br> sucesso!</p>
            <div class="botoes">
                <button id="fechar-popup">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup2">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Ocorreu um erro ao inserir registro! <br><br> Talvez você já tenha selecionado o tutor! <br> </p>
            <div class="botoes">
                <button id="fechar-popup2">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup3">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Esse tutor atingiu o limite de vagas! <br> </p>
            <div class="botoes">
                <button id="fechar-popup3">Fechar</button>
            </div>
        </div>
    </div>

    <script>
    const botaoFecharPopup = document.getElementById('fechar-popup');
    const botaoFecharPopup2 = document.getElementById('fechar-popup2');
    const sobreposicaoPopup = document.getElementById('sobreposicao-popup');
    const sobreposicaoPopup2 = document.getElementById('sobreposicao-popup2');
    const botaoFecharPopup3 = document.getElementById('fechar-popup3');
    const sobreposicaoPopup3 = document.getElementById('sobreposicao-popup3');

    function fecharPopup() {
        sobreposicaoPopup.style.display = 'none';
    }

    function fecharPopup2() {
        sobreposicaoPopup2.style.display = 'none';
    }

    function fecharPopup3() {
        sobreposicaoPopup3.style.display = 'none';
    }

    function mostrarPopup() {
        sobreposicaoPopup.style.display = 'block';
    }

    function mostrarPopup2() {
        sobreposicaoPopup2.style.display = 'block';
    }

    function mostrarPopup3() {
        sobreposicaoPopup3.style.display = 'block';
    }

    botaoFecharPopup.addEventListener('click', fecharPopup);
    botaoFecharPopup2.addEventListener('click', fecharPopup2);
    botaoFecharPopup3.addEventListener('click', fecharPopup3);
    </script>


    <?php

 
    function escolherTutor($conn, $nometutor, $nome_aluno, $serie, $RA,$vagas_tutoria,$host,$user,$password,$db_tutoria,$db_dados)
    {

       
        $conn = new mysqli($host, $user, $password, $db_tutoria);

        // Consulta para pegar o número de vagas disponíveis                                                                    
        $sql = "SELECT MIN(vagas) AS vagas_disponiveis FROM $nometutor";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $vagas = $row['vagas_disponiveis'];
        if ($vagas === null) {
            $vagas = $vagas_tutoria;
        }
        if ($vagas > 0) {
            $vagas = $vagas - 1;

            // Inserir a escolha do aluno no banco de dados
            // Inserir a escolha do aluno na tabela correspondente
            $sql_inserir = "INSERT INTO $nometutor (nome_tutor, nome_aluno, serie, ra, vagas) VALUES ('$nometutor', '$nome_aluno', '$serie', '$RA', '$vagas')";

            try {
                if ($conn->query($sql_inserir) === TRUE) {

                    // Inserir os dados na tabela "tudo"

         
                    $conn = new mysqli($host, $user, $password, $db_dados);

                    $sql_tudo = "INSERT INTO tudo (nome_tutor, nome_aluno, ra_aluno, serie) VALUES ('$nometutor', '$nome_aluno', '$RA', '$serie')";
                    if ($conn->query($sql_tudo) === TRUE) {
                        echo "<script>mostrarPopup()</script>";
                        exit();
                    } else {
                        echo "<script>mostrarPopup2()</script>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                // Erro de chave primária duplicada, exibir pop-up de erro
                echo "<script>mostrarPopup2()</script>";
            }
        } else {
            echo "<script>mostrarPopup3()</script>";
        }
    }

    if (isset($_POST["tutores"])) {
        $botaoclicado = $_POST["tutores"];
        $conn = new mysqli($host, $user, $password, $db_tutoria);

        foreach ($tables as $table) {

            if ($botaoclicado === "escolher-" . $table) {
                $nometutor = $table;
  

                
                $conn = new mysqli($host, $user, $password, $db_dados);

                $sql = "SELECT * FROM tudo WHERE ra_aluno = '$RA'";
                $result = $conn->query($sql); 
                if ($result->num_rows > 0) { 
                    echo "<script>mostrarPopup2()</script>"; 
                } else { 
                $conn->close();
                escolherTutor($conn, $nometutor, $nome_aluno, $serie, $RA,$vagas_tutoria,$host,$user,$password,$db_tutoria,$db_dados);                
                } 
 
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