<?php
    require_once '../classes/DAO/usuarioDao.php';
    require_once '../classes/Dominio/Usuarios.php';

    session_start();

    if(isset($_SESSION["array"]))
        unset($_SESSION["array"]);

    if(isset($_POST["email"])){
        $email = $_POST["email"];
        $senha = $_POST["senha"]; 
        if($email != null || $email != "" && $senha != null || $senha != ""){   
            $flag = false;

            $lista_usuario = new UsuarioDao();        
            foreach($lista_usuario->findAll() as $key => $value):
                if($value->email == $email && $value->senha == $senha){
                    $flag = true;
                    $_SESSION["id"] = $value->id;
                    break;
                }
            endforeach;
            
            if($flag){
                header("Location: index.php");
            }else{
                $mensagem = "<p>Erro de autenticação!<br>Usuário não encontrado.</p>";
            }
        }else
            $mensagem = "<p>Insira os dados de Login primeiro!</p>";
    }
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

<?php include_once("navbar.php");  ?>

    <form action="login.php" autocomplete="off" method="POST" class="form" name="form1">
        <h1>Faça seu login</h1>
        <hr>
        <input type="hidden" name="id" />

        <label for="email">E-mail:</label>
        <input type="email" name="email" />

        <label for="senha">Senha:</label>
        <input type="password" name="senha" />

        <input type="submit" value="Login" />

        <hr>
        <div>
            <?php
                if(isset($mensagem)){
                    echo $mensagem;
                }
            ?>
        </div>
    </form>

<?php include_once("footer.php");  ?>
</body>

</html>

