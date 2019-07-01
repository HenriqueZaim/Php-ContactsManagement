<!DOCTYPE html>
<?php
require_once '../classes/Dominio/TipoContato.php';
require_once '../classes/DAO/usuarioDao.php';

session_start();

if(isset($_SESSION["array"]))
    unset($_SESSION["array"]);

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}

if(isset($_POST['nome'])){
    $tipoContatoDao = new TipoContatoDao();
    $tipoNovo = new TipoContato();
    $tipoNovo->setNome($_POST['nome']);

	if($tipoContatoDao->insert($tipoNovo)){
	   $mensagem = "<p>Tipo de contato cadastrado com sucesso!</p>";
	}
}

if(isset($_GET["id"]) && isset($_GET["acao"])){

    if($_GET["acao"] == "excluir"){
        $tipoContatoDao = new TipoContatoDao();
        $id = $_GET["id"];

        if($tipoContatoDao->delete($id)){
            $mensagem = "<p>Item ".$id." excluído com sucesso!</p>";
        }

    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu de Tipos de Contato</title>
        <link rel="stylesheet" href="../_css/estilo.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>

    <?php include_once("navbar.php");  ?>
    <div>
        <form class="form" autocomplete="off" action="crudTipoContato.php" method="POST" name="form1" >
          <h1>Cadastro de Tipos de Contato</h1>
          <hr>
          
           <input type="hidden" name="id" />
          
           <label for="nome">Nome</label>
           <input type="text" name="nome" placeholder="Digite aqui.."/>
           
           <br>
          <input type="submit" value="Salvar" />
          <hr>
       </form><br>	
	
		<table id="stusuarios">
			<thead>
				<tr>
					<td>#</td>
					<td>Nome</td>
					<td>Ação</td>
				</tr>
			</thead>
			<?php
            $tipoContatoDao = new TipoContatoDao();
            foreach($tipoContatoDao->findAll() as $key => $value):?>
			<tbody>
				<tr>
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->nome;?></td>
					<td><?php echo "<a href='crudTipoContato.php?id=".$value->id."&acao=excluir'>Excluir</a>";?></td>

				</tr>
			</tbody>
			<?php endforeach; ?>
        </table>
        </div>
        <div>
            <?php if(isset($mensagem)){
                echo $mensagem;
            }     
            ?>
        </div>

    <?php include_once("footer.php");  ?>
    </body>
</html>