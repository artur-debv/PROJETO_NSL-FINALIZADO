<?php 
include './variaveis.php';

 
$conn = new mysqli($host, $user, $password, $db_tutoria);
echo "<script>fecharPopup()</script>";

$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row['Tables_in_' . $db_tutoria];
    }
}



if (isset($_POST["tutores"])) {

    $botaoclicado = $_POST["tutores"];
    foreach ($tables as $table) {
        if ($botaoclicado === "escolher-" . $table) {
            $nome = $table;
            $url = "tutorandos.php?nome=" . urldecode($nome);
            header("location: $url");
        }
    }
}

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


    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> tutoria excluida com sucesso! <br> recarregue a pagina </p>
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
        <span class='nome-tutor'>" . $table . "<br>
            vagas:
            " . $vagas[$table] . "
        </span>
        <form action='' method='post'>
            <button type='submit' class='botao-ver' name='tutores' value='escolher-" . $table . "' >Ver alunos</button>
        </form>
        <form action='' method='post'>
          <button type='submit' class='botao-excluir' name='excluir' value='excluir-" . $table . "'>Excluir</button> 
      </form>
     </div>
        ";
        }

    }
    else {
        echo "  
    <div class='tutores'>
    <h1>SEM TUTOR!</h1> <br> 
<span> Adicione Tutores  <a href='add-tutoria.php'> Aqui </a> </span>
</div> 
    ";
    }
        ?>
    </main>

    <?php

    if (isset($_POST["excluir"])) {
        $botaoclicado = $_POST["excluir"];
        foreach ($tables as $table) {
            if ($botaoclicado === "excluir-" . $table) {

                $conn = new mysqli($host, $user, $password, $db_tutoria);

                $sql_excluir = "DROP TABLE " . $table;


                if ($conn->query($sql_excluir) === TRUE) {
                    echo "<script>mostrarPopup()</script>";
                }
                $conn->close();
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