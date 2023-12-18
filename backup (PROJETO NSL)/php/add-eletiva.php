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

    <!-- Estilo personalizado -->
    <style>
    p {
        text-align: center;
        background-color: #48484887;
    }
    </style>

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

    <!-- Formulário de inserção de eletivas -->
    <div class="main-box-add">
        <h2 class="titulo">Inserção de eletivas</h2>
        <form action="" method="post" class="main-box-add-form">

            <!-- Informações sobre a inserção -->
            <p>não use acentuação em nenhum campo para evitar conflito interno!</p>

            <!-- Campos do formulário -->
            <label class="form-label" for="nome-eletiva">Digite o nome da Eletiva:</label>
            <input type="text" required id="nome-eletiva" name="nome-eletiva" class="campos">

            <label class="form-label" for="1-nome">Dgite o 1º nome do Professor:</label>
            <input type="text" required id="1-nome" class="nomes" name="1prof">

            <label class="form-label" for="2-nome">Dgite o 2º nome do Professor:</label>
            <input type="text" id="2-nome" name="2prof" class="nomes">

            <label class="form-label" for="3-nome">Dgite o 3º nome do Professor(se tiver):</label>
            <input type="text" id="3-nome" name="3prof" class="nomes">

            <label for="curso">Selecione o curso da eletiva:</label>
            <select name="cursos" id="curso" required>
                <option value="INFORMATICA">INFOMÁRTICA</option>
                <option value="ADM">ADMINISTRAÇÃO</option>
                <option value="HUMANAS">HUMANAS</option>
            </select>

            <label class="form-label" for="vagas">Digite o numero de vagas:</label>
            <input type="text" class="N-vagas" name="vagas" required>

            <br><br>

            <div class="botoes">
                <!-- Botões de reset e submit -->
                <input type="reset">
                <input type="submit" name="enviar">
            </div>
        </form>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Eletiva inserida com <br> sucesso!</p>
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
        $nome_eletiva = str_replace(' ','_', $_POST['nome-eletiva']); 
        $professor_1 =  str_replace(' ','_', $_POST['1prof']);
        $professor_2 =  str_replace(' ','_', $_POST['2prof']);
        $professor_3 =  str_replace(' ','_', $_POST['3prof']); 
        $cursor = $_POST['cursos']; 
        $vagas = $_POST["vagas"];
   
        // Conecta ao banco de dados
        $conn = new mysqli($host, $user, $password, $db_eletiva);

        // Cria a tabela se não existir
        $sql = "CREATE TABLE IF NOT EXISTS $nome_eletiva ( 
            nome_eletiva varchar(255),
            professor_1 varchar(255),
            professor_2 varchar(255),    
            professor_3 varchar(255),    
            curso varchar(255),
            vagas int
        )";

        if ($conn->query($sql) === TRUE) {
            // Inserção dos dados na tabela
            $sql_insert = "INSERT INTO $nome_eletiva (nome_eletiva, professor_1, professor_2, professor_3, curso, vagas) 
                            VALUES ('$nome_eletiva', '$professor_1', '$professor_2', '$professor_3','$cursor' , '$vagas')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<script> mostrarPopup() </script>";

                // Cria a segunda tabela em outro banco de dados
                $conn->close(); // Fecha a conexão com o primeiro banco de dados

                $conn = new mysqli($host, $user, $password, $db_escolhas); // Conecta-se ao segundo banco de dados
                $sql_escolhas = "CREATE TABLE IF NOT EXISTS $nome_eletiva (  
                        nome_eletiva varchar(255),
                        nome_aluno varchar(255),
                        serie varchar(255),
                        ra int,
                        primary key(ra)
                    ) default charset utf8;";

                if ($conn->query($sql_escolhas) === TRUE) {
                    $conn->close(); // Fecha a conexão com o segundo banco de dados, se necessário
                } else {
                    echo "Erro ao criar a segunda tabela: " . $conn->error;
                }
            } else {
                echo "Erro ao inserir dados na tabela: " . $conn->error;
            }
        } else {
            echo "Erro ao criar a tabela: " . $conn->error;
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