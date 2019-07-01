<?php
require_once '../classes/DAO/contatoDao.php';
require_once '../classes/DAO/usuarioDao.php';
require_once '../classes/Dominio/Contatos.php';
require_once '../classes/Dominio/TipoContato.php';
require_once '../classes/DAO/fotoDao.php';
require_once '../classes/Dominio/Foto.php';

session_start();

if(!isset($_SESSION["id"])){
header("Location: login.php");
}

if(isset($_SESSION["array"]))
    unset($_SESSION["array"]);

if(isset($_GET["excluiTelefone"])){

$contatoDao = new contatoDao();
$telefone = $_GET["excluiTelefone"];

if($contatoDao->deleteTelefone($telefone)){
    $mensagem = "<p>Telefone do contato excluído com sucesso!</p>";
}

}

if(isset($_GET["id"]) && isset($_GET["acao"])){
if($_GET["acao"] == "excluir"){
    $contatoDao = new contatoDao();
    $id = $_GET["id"];

    if($contatoDao->delete($id)){
        $mensagem = "<p>Item ".$id." excluído com sucesso!</p>";
    }
}
}

$tipo = new TipoContatoDao();
?>
<html>

<head>
<meta charset="UTF-8">
<title>Editar Contato</title>
<link rel="stylesheet" href="../_css/estilo.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
    .display-none {
        display: none;
    }
    
    .lista{
        list-style:none;
    }
    
    
</style>

<script>
    function mostra(e) {
        let doc = document.getElementById(e);
        if (doc.classList.contains("display-none")) {
            doc.classList.remove("display-none")
        } else
            doc.classList.add("display-none")
    }
</script>
</head>

<body>

<?php include_once("navbar.php");  ?>

<div class="form">
    <h1>Lista de contatos</h1>
    <?php 
        $meu_contato = new contatoDao();
        foreach($meu_contato->findAll() as $key => $value):
    ?>
    <label><?php echo $value->apelido;?></label>
    <button type="button" class="click" onclick="mostra('lista<?php echo $value->id; ?>')">Ver mais</button>
    <br>
    <ul class="display-none lista" id="lista<?php echo $value->id; ?>">
        <?php
            $foto = new FotoDao();

            foreach($foto->findContImg($value->id) as $chave => $imagem):
                echo $imagem->nome;
                echo $imagem->tipo;
                echo $imagem->base64_encode($imagem->conteudo);
                echo "<img src='data:".$imagem->tipo.";base64,".base64_encode($imagem->conteudo)."' />";
                echo "<embed src='data:".$imagem->tipo.";base64,".base64_encode($imagem->conteudo)."'/>";
            endforeach;

        ?>
        <li><b>Nome:</b> <?php echo $value->nome;?></li>
        <li><b>E-mail:</b> <?php echo $value->email;?></li>
        <li><b>Data de Nascimento:</b> <?php 
        $ano = substr($value->dtnasc,0,4);
        $dia = substr($value->dtnasc, 8);
        $mes = substr($value->dtnasc, 5, 2);
        echo $dia."/".$mes."/".$ano;?></li>
        <li><b>Tipo:</b> <?php
                    $achou = false;
                    foreach($tipo->findAll() as $key => $item):
                        if($item->id == $value->idTipo){
                            echo $item->nome;
                            $achou = true;
                            break;
                        }
                    endforeach;
                    if(!$achou){
                        echo "Não encontrado";
                    }
                    ?>
        </li>
        <li><b>Telefones:</b> <?php
                    if($meu_contato->findAllTels($value->id) == null):
                        echo " Nenhum telefone encontrado.";
                    else:
                    foreach($meu_contato->findAllTels($value->id) as $key => $item):
                        echo $item->telefone;
                        echo "&emsp;<a href='listaContatos.php?excluiTelefone=".$item->telefone."'><i class='fas fa-times-circle'></i></a>";
                    ?>
                    <br>
                    <?php
                    endforeach;
                    endif;
                    ?> 
        </li><br>

        <li ><?php echo "<a title='Editar' href='editaContato.php?id=".$value->id."'><i class='fas fa-edit'></i></a>";?>&emsp;<?php echo "<a title='Excluir' href='listaContatos.php?id=".$value->id."&acao=excluir'><i class='fas fa-times'></i></a>";?></li>
    </ul>
    <br>
    <?php
        endforeach;

    ?>
    <a style="text-algin: center;" href="crudContatos.php">Novo Contato</a>
    </div>

<?php include_once("footer.php");  ?>
</body>

</html>