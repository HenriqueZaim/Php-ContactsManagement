<?php
require_once '../classes/DAO/usuarioDao.php';
require_once '../classes/Dominio/Usuarios.php';

 if(isset($_POST['nome'])){
    $usuarioDao = new UsuarioDao();
    $usuario = new Usuarios();
        
    if($_POST['nome'] != "" && $_POST['email'] != "" && $_POST['senha'] != ""){

        $repetido = false;

        foreach($usuarioDao->findAll() as $item => $value){
            if($value->email == $_POST['email']){
                $repetido = true;
                break;
            }else
                continue;
        }
        if(!$repetido){

            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);

            if($usuarioDao->insert($usuario)){
            header('Location: login.php');
            } else {
            $mensagem = "<p>Erro ao cadastrar este usuário!</p>";
            }
        }else{
            $mensagem = "<p>Usuário já cadastrado no sistema</p>";
        }
    }else{
        $mensagem = "<p>Erro ao cadastrar este usuário!</p>";
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

<?php include_once("navbar.php");  ?>

    <form action="formcadusuario.php" autocomplete="off" class="form" method="POST" name="form1">
        <h1>Cadastro de Usuários</h1>
        <hr>
        <input type="hidden" name="id" />

        <label for=nome>Nome:</label>
        <input type="text" name="nome" />

        <label for=email>E-mail:</label>
        <input type="text" name="email" />

        <label for=senha>Senha:</label>
        <input type="password" name="senha" />

        <input type="submit" value="Cadastrar" />
        <hr>
    </form>
    <div>
        <?php
                if(isset($mensagem)){
                    echo $mensagem;
                }
            ?>
    </div>

    <?php include_once("footer.php");  ?>
</body>

</html>