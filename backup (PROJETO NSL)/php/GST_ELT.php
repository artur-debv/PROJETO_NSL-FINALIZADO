<?php
ob_start();
include './variaveis.php';

 

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.ELET.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Eletiva Excluida com <br> sucesso!</p>
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


    <header class="header">
        <div class="brazao">
            <a href="../Tutoria-Eletiva.html"><img src="img/brazao.png" alt="Brazao" class="brazao"></a>
        </div>

        <div class="header-user">
            <a href="#" class="nome">
                ADMINISTRADOR
            </a>
            <img src="img/Imagem1.svg" alt="" class="user">
        </div>
    </header>

    <main class="eletiva-bg">
        <?php
 if ($result->num_rows != 0) {

        foreach ($tables as $table) {

            $min_vagas_query = "SELECT MIN(vagas) AS min_vagas FROM $table";
            $min_result = $conn->query($min_vagas_query);
            $min_row = $min_result->fetch_assoc();
            $min_vagas = $min_row['min_vagas'];

            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            echo "                                                  
            <div class='eletivas'> 
            <h2>ELETIVA:</h2>  
            <span class='nome-tutor'>" . str_replace("_"," ",$row["nome_eletiva"])  . " <br> </span>                     
            <h2>Professores:</h2>  
            <span class='nome-eletiva'>" . str_replace("_"," ",$row["professor_1"]) . " <br> </span>
            <span class='nome-eletiva'>" . str_replace("_"," ",$row["professor_2"]) . " <br> </span>
            <span class='nome-eletiva'>" . str_replace("_"," ",$row["professor_3"]) . " <br> </span>
            <span class'nome-eletiva'>
            <b>vagas:</b>
            " . $min_vagas . "
            </span>
            <form action='' method='get'>
                <button type='submit' class='botao' name='eletiva' value='escolher-" . $table . "' > Ver alunos   </button> 
            </form> 
            <form action='' method='get'>
                <button type='submit' class='botao-excluir' name='excluir' value='excluir-" . $table . "'>Excluir</button> 
            </form> 

                    </div>";
        }
    }
    else {
        echo "  
    <div class='eletivas'>
    <h1>SEM ELETIVAS!</h1> <br> 
<span> Adicione Eletivas<a href='add-eletiva.php'> Aqui </a> </span>
</div> 
    ";
    }
        ?>
    </main>

    <?php
    if (isset($_GET["excluir"])) {
        $botaoclicado = $_GET["excluir"];
        foreach ($tables as $table) {
            if ($botaoclicado === "excluir-" . $table) {
 
                $conn_eletiva = new mysqli($host, $user, $password, $db_eletiva);
                $conn_escolhas = new mysqli($host, $user, $password, $db_escolhas);

                $sql_excluir_eletiva = "DROP TABLE IF EXISTS " . $table;
                $sql_excluir_escolhas = "DROP TABLE IF EXISTS " . $table;

                if ($conn_eletiva->query($sql_excluir_eletiva) === TRUE && $conn_escolhas->query($sql_excluir_escolhas) === TRUE) {
                    echo "<script>mostrarPopup()</script>";
                } else {
                    echo "Erro ao excluir a tabela: " . $conn_eletiva->error;
                }

                $conn_eletiva->close();
                $conn_escolhas->close();
            }
        }
    }
    if (isset($_GET["eletiva"])) {

        $botaoclicado = $_GET["eletiva"];
        foreach ($tables as $table) {
            if ($botaoclicado === "escolher-" . $table) {
                $nome = $table;
                $url = "eletivandos.php?nome=" . urldecode($nome);
                header("location: $url");
                ob_end_flush();
            }
        }
    }
    ?>
 
 <footer>
    <div class="creditos">
      <p class="projeto-info">Projeto realizado pelos alunos de Altas Habilidades da escola "EEEM Nossa Senhora"</p>
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
      <p class="endereco-info">Endereço: 🏫 𝚁𝚞𝚊 𝚂𝚎𝚗. 𝙴𝚞𝚛𝚒𝚌𝚘 𝚁𝚎𝚣𝚎𝚗𝚍𝚎, 𝟹𝟸𝟶 - 𝙲𝚎𝚗𝚝𝚛𝚘<br> 𝙿𝚒𝚗𝚑𝚎𝚒𝚛𝚘𝚜/𝙴𝚂</p>
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