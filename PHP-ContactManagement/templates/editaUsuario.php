<?php
require_once '../classes/DAO/usuarioDao.php';
require_once '../classes/Dominio/Usuarios.php';

session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}

if(isset($_SESSION["array"]))
    unset($_SESSION["array"]);

if(isset($_POST["nome"])){
    $usuarioNovo = new Usuarios();
    $usuarioDao = new usuarioDao();
    
    $usuarioNovo->setNome($_POST['nome']);
    $usuarioNovo->setEmail($_POST['email']);
    $usuarioNovo->setSenha($_POST['senha']);
    $id = $_POST["id"];
    
    if($usuarioDao->update($usuarioNovo,$id)){
        if($id == $_SESSION["id"]){
            session_destroy();
            header('Location: index.php');
        }
        else{
            header('Location: crudUsuario.php');
        }
    } else {
        header('Location: erro.php');
    }
}

if(isset($_GET["id"])){
    $usuarioDao = new UsuarioDao();
    $id = $_GET["id"];
        
    $dado = $usuarioDao->find($id);
    $nome = $dado->nome;
    $email = $dado->email;

}else{
    header('Location: crudUsuario.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <?php include_once("navbar.php");  ?>

    <form action="editaUsuario.php" class="form" method="POST" name="form1">
        <h1>Editar Contato</h1>
        <hr>

        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <label for=nome>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" />

        <label for=email>E-mail:</label>
        <input type="text" name="email" value="<?php echo $email; ?>" />
        
        <label for=senha>Senha:</label>
        <input type="password" name="senha" />
        
        <input type="submit" value="Editar" />
        <input type="button" value="Voltar" onclick="crudUsuario.php" />
        <hr>
    </form><br>

    <?php include_once("footer.php");  ?>
</body>

</html>