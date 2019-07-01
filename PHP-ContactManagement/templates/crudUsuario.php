<!DOCTYPE html>
<?php

require_once '../classes/DAO/usuarioDao.php';
require_once '../classes/Dominio/Usuarios.php';
session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}

if(isset($_SESSION["array"]))
    unset($_SESSION["array"]);

if(isset($_POST['nome'])){
    $usuarioDao = new UsuarioDao();
    $usuarioNovo = new Usuarios();
    $repetido = false;

    foreach($usuarioDao->findAll() as $item => $value){
        if($value->email == $_POST['email']){
            $repetido = true;
            break;
        }else
            continue;
    }
    if(!$repetido){
        $usuarioNovo->setNome($_POST['nome']);
        $usuarioNovo->setEmail($_POST['email']);
        $usuarioNovo->setSenha($_POST['senha']);

        if($usuarioDao->insert($usuarioNovo)){
        $mensagem = "<p>Usuário cadastrado com sucesso!</p>";
        }
    }else
        $mensagem = "<p>Usuário já cadastrado no sistema</p>";
}

if(isset($_GET["id"]) && isset($_GET["acao"])){
    
    if($_GET["acao"] == "excluir"){
        $usuarioDao = new UsuarioDao();
        $id = $_GET["id"];
        
        if($id == $_SESSION["id"]){
            $mensagem = "<p>Usuário não pode ser excluído pois está logado!</p>";
        }else{
            if($usuarioDao->delete($id)){
                $mensagem = "<p>Item ".$id." excluído com sucesso!</p>";
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu de Usuários</title>
        <link rel="stylesheet" href="../_css/estilo.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <?php include_once("navbar.php");  ?>

       <form class="form" autocomplete="off" action="crudUsuario.php" method="POST" name="form1" >
          <h1>Cadastro de Usuários</h1>
          <hr>
          
           <input type="hidden" name="id" />
          
           <label for="nome">Nome</label>
           <input type="text" name="nome" placeholder="Digite aqui.."/>
		 
           <label for="email">E-mail</label>
           <input type="email" name="email" placeholder="Digite aqui.."/>
          
           <label for="senha">Senha</label>
           <input type="password" name="senha" placeholder="Digite aqui.."/>
           
           <br>
          <input type="submit" value="Salvar" />
          <hr>
       </form><br>	
	
		<table id="stusuarios">
			<thead>
				<tr>
					<td>#</td>
					<td>Nome</td>
					<td>E-mail</td>
					<td>Ação</td>
				</tr>
			</thead>
			<?php
            $usuarioDao = new usuarioDao();
            foreach($usuarioDao->findAll() as $key => $value):?>
			<tbody>
				<tr>
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->nome;?></td>
					<td><?php echo $value->email;?></td>
					<td><?php echo "<a href='editaUsuario.php?id=".$value->id."'>Editar</a>";?>//<?php echo "<a href='crudUsuario.php?id=".$value->id."&acao=excluir'>Excluir</a>";?></td>

				</tr>
			</tbody>
			<?php endforeach; ?>
		</table>
        <div>
            <?php if(isset($mensagem)){
                echo $mensagem;
            }     
            ?>
        </div>

    <?php include_once("footer.php");  ?>
    </body>
</html>