<?php
    require_once '../classes/DAO/usuarioDao.php';
    require_once '../classes/Dominio/Usuarios.php';

    session_start();

    if(!isset($_SESSION["id"])){
        header("login.php");
    }

    if(isset($_SESSION["array"]))
        unset($_SESSION["array"]);
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">   
</head>

<body>
    <?php include_once("navbar.php");  ?>

        <div class="flex">
            
                <div class="relatorio">
                    
                    <div class="relatorio-image">

                    </div>
                    <div class="link-relatorio">
                        <b class="link">Relatório de Contatos</b>
                    </div>
                    <span style="position: absolute; left: 45%; margin-top: 20px; font-size: 2rem;">
                        <a href="ContatoPdf.php" style="color: black;"><i class="fas fa-eye"></i></a>
                    </span>
                        
                </div>

                <div class="relatorio">
                    
                    <div class="relatorio-image">

                    </div>
                    <div class="link-relatorio">
                        <b class="link">Gráfico dos tipos de contatos</b>
                    </div>
                    <span style="position: absolute; left: 45%; margin-top: 20px; font-size: 2rem;">
                        <a href="testeGrafico.php" style="color: black;"><i class="fas fa-eye"></i></a>
                    </span>
                        
                </div>
            
        </div>

    <?php include_once("footer.php");  ?>
</body>

</html>






