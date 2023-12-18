<?php
include './variaveis.php';

$RA = $_GET['RA'];
$serie = $_GET['serie'];
$curso_tec = $_GET['curso_tec'];
$nome_aluno = $_GET['nome'];

$conn = new mysqli($host, $user, $password, $db_eletiva);

$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row['Tables_in_' . $db_eletiva];
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.ELET.css">
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

    <title>Eletiva | nsl</title>
    <style>
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
                <?php echo $nome_aluno . "<br>" . $serie . "<br>" . $curso_tec;   ?>
            </a>
            <img src="img/Imagem1.svg" alt="" class="user">
        </div>
    </header>

    <h1 class="title-eletiva">eletivas do curso de <br> <?php echo $curso_tec; ?></h1>

    <main class="eletiva-bg">
        <?php


        if ($result->num_rows != 0) {

            foreach ($tables as $table) {

                $conn = new mysqli($host, $user, $password, $db_eletiva);

                $min_vagas_query = "SELECT MIN(vagas) AS min_vagas FROM $table";
                $min_result = $conn->query($min_vagas_query);
                $min_row = $min_result->fetch_assoc();
                $min_vagas = $min_row['min_vagas'];

                $sql = "SELECT * FROM $table";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if ($row["curso"] == $curso_tec) {
                    echo "
                    <div class='eletivas'> 
                        <h2>ELETIVA:</h2>  
                        <span class='nome-tutor'>" . str_replace("_", " ", $row["nome_eletiva"]) . " <br> </span>                     
                        <h2>Professores:</h2>  
                        <span class='nome-eletiva'>" . str_replace("_", " ", $row["professor_1"]) . " <br> </span>
                        <span class='nome-eletiva'>" . str_replace("_", " ", $row["professor_2"]) . " <br> </span>
                        <span class='nome-eletiva'>" . str_replace("_", " ", $row["professor_3"]) . " <br> </span>
                        <h2>Curso:</h2>
                        <span class='nome-eletiva'>" . str_replace("_", " ", $row["curso"]) . " <br> </span>
                        <span class='nome-eletiva'>
                            <b>vagas:</b>
                            " . $min_vagas . " 
                        </span>
                        <form action='' method='post'>
                            <button type='submit' class='botao' name='eletivas' value='escolher-" . $table . "'> Escolher </button>
                        </form>
                    </div>";
                }
            }
        } else {
            echo "  
        <div class='nada'>
        <h1>SEM ELETIVAS!</h1> <br> 
    <span>peça algum gestor para adicionar Eletivas </span>
    </div> 
        ";
        }
        ?>
    </main>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">CONFIRMADO!</h2>
            <p>Você selecionou a eletiva com <br> sucesso!</p>
            <div class="botoes">
                <button id="fechar-popup">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup2">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Ocorreu um erro ao inserir registro! <br><br> Talvez você já tenha selecionado a eletiva! <br> </p>
            <div class="botoes">
                <button id="fechar-popup2">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup3">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Essa eletiva atingiu o limite de vagas! <br> </p>
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

    function escolherEletiva($nomeEletiva, $nome_aluno, $serie, $RA, $professor_1, $professor_2, $professor_3, $host, $user, $password, $db_eletiva, $db_escolhas, $db_dados)
    {

        $conn = new mysqli($host, $user, $password, $db_dados);
        $sql_create_table = "CREATE TABLE IF NOT EXISTS Tudor_eletiva(
        nome_eletiva varchar(255),
        nome_aluno varchar(255),
        serie varchar(255),
        ra int
       )default charset utf8;";

        $conn->close();

        $conn = new mysqli($host, $user, $password, $db_eletiva);
        // Consulta para pegar o número de vagas disponíveis
        $sql = "SELECT MIN(vagas) AS vagas FROM $nomeEletiva";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $vagas = $row['vagas'];

        if ($vagas === null) {
            $vagas = 40;
        }

        if ($vagas > 0) {
            $vagas = $vagas - 1;

            $conn->close();
            $conn = new mysqli($host, $user, $password, $db_escolhas);

            // Use a tabela correta no banco de dados $db_escolhas
            $sql_inserir = "INSERT INTO $nomeEletiva(nome_eletiva, nome_aluno, serie, ra) VALUES ('$nomeEletiva', '$nome_aluno', '$serie', '$RA')";

            try {

                if ($conn->query($sql_inserir) === TRUE) {

                    $conn->close();
                    $conn = new mysqli($host, $user, $password, $db_dados);
                    $sql_tudo = "INSERT INTO Tudor_eletiva( nome_aluno,nome_eletiva,serie, ra) 
                    VALUES ( '$nome_aluno','$nomeEletiva', '$serie', '$RA')";
                    if ($conn->query($sql_tudo) === TRUE) {
                        $conn->close();

                        $conn = new mysqli($host, $user, $password, $db_eletiva);
                        $sql = "INSERT INTO $nomeEletiva (nome_eletiva, professor_1, professor_2, professor_3, vagas) 
                        VALUES ('$nomeEletiva', '$professor_1', '$professor_2', '$professor_3', $vagas)";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>mostrarPopup()</script>";
                        }
                        $conn->close();
                        exit();
                    } else {
                        echo "<script>mostrarPopup2()</script>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script>mostrarPopup2()</script>";
            }
        } else {
            echo "<script>mostrarPopup3()</script>";
        }
    }
    if (isset($_POST["eletivas"])) {

        $botaoclicado = $_POST["eletivas"];
        $conn = new mysqli($host, $user, $password, $db_eletiva);

        foreach ($tables as $table) {
            if ($botaoclicado === "escolher-" . $table) {
                $nome_eletiva = $table;

                $select_query = "SELECT * FROM $nome_eletiva LIMIT 1";
                $result = $conn->query($select_query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $professor_1 = $row['professor_1'];
                    $professor_2 = $row['professor_2'];
                    $professor_3 = $row['professor_3'];
                }

                $conn = new mysqli($host, $user, $password, $db_escolhas);

                $sql = "CREATE TABLE IF NOT EXISTS $nome_eletiva(  
                    nome_eletiva varchar(255),
                    nome_aluno varchar(255),
                    serie varchar(255),
                    ra int,
                    vagas int,
                    primary key(vagas)
                )default charset utf8;";

                $conn->query($sql);

                escolherEletiva($nome_eletiva, $nome_aluno, $serie, $RA, $professor_1, $professor_2, $professor_3, $host, $user, $password, $db_eletiva, $db_escolhas, $db_dados);
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