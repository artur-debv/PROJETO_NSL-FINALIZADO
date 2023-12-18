<?php 
include './variaveis.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nsl-Professor</title>

    <link rel="stylesheet" href="css/style-PFR.css">

    <link rel="stylesheet" href="css/style-tabela.css">
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    $nome =preg_replace('/\d/', '',  $_GET['senha']); 


    $conn = new mysqli($host, $user, $password, $db_tutoria);

    $sql = "SELECT nome_aluno, serie, ra FROM $nome";
    $result = $conn->query($sql);
    ?>
    <header class="header-bg">
        <div class="header">
            <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
            <div class="header-menu">
                <span class="nome"> <?php echo $nome?></span>
                <img class="user" src="img/Imagem1.svg" alt="User">
            </div>
        </div>
    </header>

    <main class="main">
        <div class="alunos">
            <h1>Tutoria</h1>

            <h2>Alunos</h2>

            <?php

        echo "<table clas='teste'>";
        echo "<tr><th>Nome do Aluno</th><th>Série</th><th>RA</th></tr>";

        // Loop através dos resultados e exiba cada linha na tabela
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["nome_aluno"] . "</td><td>" . $row["serie"] . "</td><td>" . $row["ra"] . "</td></tr>";
        }

        echo "</table>";
        ?>


            <button class="export" onclick="exportToExcel()">Exportar para Excel</button>
        </div>

    </main>

    <script>
    function exportToExcel() {

        var table = XLSX.utils.table_to_sheet(document.querySelector('table'));

        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, table, 'Dados');

        XLSX.writeFile(wb, 'dados_alunos.xlsx');
    }
    </script>

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