<?php
    require_once '../classes/DAO/usuarioDao.php';
    require_once '../classes/Dominio/Usuarios.php';

    session_start();

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

    <?php include_once("footer.php");  ?>
</body>

</html>