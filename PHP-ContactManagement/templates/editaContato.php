<?php
require_once '../classes/DAO/contatoDao.php';
require_once '../classes/DAO/usuarioDao.php';
require_once '../classes/Dominio/Contatos.php';
require_once '../classes/Dominio/TipoContato.php';

session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}
if(isset($_SESSION["array"]))
    unset($_SESSION["array"]);

if(isset($_POST["nome"])){
    $contatoNovo = new Contatos();
    $contatoDao = new contatoDao();
    
    $contatoNovo->setNome($_POST['nome']);
    $contatoNovo->setApelido($_POST['apelido']);
    $contatoNovo->setEmail($_POST['email']);
    $contatoNovo->setDtNasc($_POST['dtnasc']);
    $contatoNovo->setTipoContato($_POST['tipoContato']);
    $id = $_POST["id"];
    
    if($contatoDao->update($contatoNovo,$id)){
        header('Location: crudContatos.php');
    } else {
        header('Location: erro.php');
    }
}

if(isset($_GET["id"])){
    $contatoDao = new ContatoDao();
    $id = $_GET["id"];
        
    $dado = $contatoDao->find($id);
    $nome = $dado->nome;
    $email = $dado->email;
    $apelido = $dado->apelido;
    $dtnasc = $dado->dtnasc;
    $tipoContato = $dado->idTipo;
}else{
    header('Location: crudContatos.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

<?php include_once("navbar.php");  ?>

    <form action="editaContato.php" class="form" method="POST" name="form1">
        <h1>Editar Contato</h1>
        <hr>

        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <label for=nome>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" />

        <label for=apelido>Apelido:</label>
        <input type="text" name="apelido" value="<?php echo $apelido; ?>" />

        <label for=email>E-mail:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" />

        <label for=dtnasc>Data de nascimento:</label>
        <input type="date" name="dtnasc" value="<?php echo $dtnasc; ?>" />

        <label for="tipoContato">Tipo do Contato</label>
        <select name="tipoContato">
            <?php
                    $achou = false;
                    $tipo = new TipoContatoDao();
                    foreach($tipo->findAll() as $key => $value):
                        if($value->id == $tipoContato){
                            $achou = true;
                            echo "<option value=".$value->id." selected>".$value->nome." </option>";
                        }else
                            echo "<option value=".$value->id.">".$value->nome."</option>";
                    endforeach;
                    if(!$achou){
                        echo "<option value='' selected>Selecione..</option>";
                    }
                 ?>
        </select>
        <input type="submit" value="Editar" />
        <hr>
    </form>
    <?php include_once("footer.php");  ?>
</body>

</html>