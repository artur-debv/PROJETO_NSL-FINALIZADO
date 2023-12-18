 <?php
include './variaveis.php';

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    
    $conn = new mysqli($host, $user, $password, $db_dados);

    $sql_busca = "SELECT nome_aluno,nome_eletiva,serie,ra FROM Tudor_eletiva ORDER BY nome_eletiva ASC";

    $result = $conn->query($sql_busca);

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
     <link rel="stylesheet" href="css/style-tabela.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">


     <style>
     #sobreposicao-popup2 {
         display: none;
         /* Inicialmente oculto */
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
     }

     #conteudo-popup2 {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: #fff;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
     }

     #fechar-popup2 {
         border: none;
         width: 82px;
         height: 40px;
         font-weight: bold;
         text-align: center;
         border-radius: 5px;
         background-color: #007bff;
         font-size: 20px;
     }

     .enviar {
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
     </style>
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

     <br><br><br>

     <main class="main">
         <div class="alunos">
             <h1>Todas as escolhas</h1>

             <h2>Eletivas e Alunos</h2>

             <?php
                echo "<table class='teste'>";
                echo "<tr><th>Nome da Eletiva</th><th>Nome do Aluno</th><th>Série</th><th>RA</th></tr>";

                // Loop através dos resultados e exiba cada linha na tabela

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . str_replace("_"," ",$row["nome_eletiva"])  . "</td>";
                    echo "<td>" . $row["nome_aluno"] . "</td>";
                    echo "<td>" . $row["serie"] . "</td>";
                    echo "<td>" . $row["ra"] . "</td>";
                    echo "</tr>";
                    echo "<tr><td colspan='4'><hr></td></tr>"; // Adicione uma linha horizontal após cada linha de dados
                }

                echo "</table>";
                $conn->close();
                ?>

             <button class="export" onclick="exportToExcel()">Exportar para Excel</button>
             <button class="excluir-dados" onclick="mostrarPopup()">Excluir dados</button>
         </div>

         <!-- Pop-up -->
         <div id="sobreposicao-popup">
             <div id="conteudo-popup">
                 <h2>Excluir dados</h2>
                 <p>Tem certeza que deseja <br>excluir todos os dados?</p>
                 <button id="fechar-popup"> Fechar</button>
                 <form method="post">
                     <button class="enviar" type="submit" name="enviar">Sim</button>
                 </form>
             </div>
         </div>

         <!-- Pop-up -->
         <div id="sobreposicao-popup2">
             <div id="conteudo-popup2">
                 <h2>Sucess</h2>
                 <p>Você excluiu os dados <br>com sucesso!</p>
                 <button id="fechar-popup2">Fechar</button>

             </div>
         </div>

         <!-- Script JavaScript -->
         <script>
         const botaoFecharPopup = document.getElementById('fechar-popup');
         const sobreposicaoPopup = document.getElementById('sobreposicao-popup');
         const botaoFecharPopup2 = document.getElementById('fechar-popup2');
         const sobreposicaoPopup2 = document.getElementById('sobreposicao-popup2');
         const enviar = document.getElementById('enviar_sim');



         function fecharPopup() {
             sobreposicaoPopup.style.display = 'none';
         }

         function mostrarPopup() {
             sobreposicaoPopup.style.display = 'block';
         }

         function fecharPopup2() {
             sobreposicaoPopup2.style.display = 'none';
         }

         function mostrarPopup2() {
             sobreposicaoPopup2.style.display = 'block';
         }



         botaoFecharPopup.addEventListener('click', fecharPopup);
         botaoFecharPopup2.addEventListener('click', fecharPopup2);

         function exportToExcel() {

             var table = XLSX.utils.table_to_sheet(document.querySelector('table'));

             var wb = XLSX.utils.book_new();
             XLSX.utils.book_append_sheet(wb, table, 'Dados');

             XLSX.writeFile(wb, 'dados_alunos.xlsx');

         }
         </script>
     </main>

     <?php
        $conn = new mysqli($host, $user, $password, $db_dados);

        if (isset($_POST["enviar"])) {

            $sql = "DELETE FROM tudor_eletiva";

            if ($conn->query($sql) === TRUE) {
                echo "<Script> fecharPopup() </script>";
                echo "<Script> mostrarPopup2() </script>";
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