    <!DOCTYPE html>
    <?php
    require_once '../classes/DAO/usuarioDao.php';
    require_once '../classes/Dominio/Contatos.php';
    require_once '../classes/Dominio/TipoContato.php';
    require_once '../classes/Dominio/Foto.php';
    session_start();

    if(!isset($_SESSION["id"])){
        header("login.php");
    }

    if(isset($_POST["telefone"])){
        if(!isset($_SESSION["array"])){
            $array = array();
            $_SESSION["array"] = $array;
        }
        array_push($_SESSION["array"], $_POST["telefone"]);
    }

    $tipo = new TipoContatoDao();

    if(isset($_POST['nome'])){
        if(isset($_SESSION["array"])){
            $contatoDao = new contatoDao();
            $contatoNovo = new Contatos();
            $foto = new Foto();

            $contatoNovo->setNome($_POST['nome']);
            $contatoNovo->setApelido($_POST['apelido']);
            $contatoNovo->setEmail($_POST['email']);
            $contatoNovo->setDtNasc($_POST['dtnasc']);
            $contatoNovo->setTipoContato($_POST['tipoContato']);
            $contatoNovo->setTelefone(array_unique($_SESSION["array"]));

            $arquivo = $_FILES['foto']['tmp_name']; 
            $tamanho = $_FILES['foto']['size'];
            $tipo    = $_FILES['foto']['type'];
            $nome  = $_FILES['foto']['name'];

            if ($arquivo != "none" ){
                $fp = fopen($arquivo, "rb");
                $conteudo = fread($fp, $tamanho);
                $conteudo = addslashes($conteudo);
                fclose($fp); 

                $foto->setNome($nome);
                $foto->setTipo($tipo);
                $foto->setTamanho($tamanho);
                $foto->setConteudo($conteudo);

                if($contatoDao->insert($contatoNovo, $foto)){
                    header("Location: listaContatos.php");
                }else
                    echo "erro";
            }else
                $mensagem = "insira uma foto";  
        }else{
            $mensagem = "Insira o telefone";
        }
    }

    ?>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Contato</title>
        <link rel="stylesheet" href="../_css/estilo.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    </head>

    <body>
        <?php include_once("navbar.php");  ?>
            <form action="crudContatos.php" autocomplete="off" method="post" class="form">
                <h2>Insira o(s) número(s) de telefone do contato</h2>        
                <label for="telefone">Telefone*</label>
                    <input type="text" name="telefone">
                    <br>
                    <button type="submit">Adicionar Telefone</button>
                    <hr>
                    <?php if(isset($mensagem)){
                            echo $mensagem;
                        }     
                    ?>
            </form>
            <form class="form" autocomplete="off" action="crudContatos.php" method="POST" name="form1" enctype="multipart/form-data">
                <h2>Insira os dados do contato</h2>

                <input type="hidden" name="id" />

                <label for="nome">Nome*</label>
                <input type="text" name="nome" placeholder="Digite aqui.." />

                <label for="apelido">Apelido*</label>
                <input type="text" name="apelido" placeholder="Digite aqui.." />

                <label for="email">E-mail*</label>
                <input type="email" name="email" placeholder="Digite aqui.." />

                <label for="dtnasc">Data de Nascimento*</label>
                <input type="date" name="dtnasc" placeholder="Insira aqui.." />

                <label for="tipoContato">Tipo do Contato*</label>
                <select name="tipoContato">
                    <option value="" selected>Selecione..</option>
                    <?php
                            foreach($tipo->findAll() as $key => $value):
                                echo "<option value=".$value->id.">".$value->nome."</option>";
                            endforeach;
                        ?>
                </select>
                <br>

                <label for="foto">Foto do contato*</label>
                <input id="foto" name="foto" type="file">
                <br>

                <input type="submit" value="Salvar" />
                <hr>
            </form><br>
            
            <div class="form" style="margin-bottom: 50px; position: absolute; left: 5%; top: 25%;">
            <?php
            if(isset($_SESSION["array"])){
                $array = $_SESSION["array"];
            ?>
            
            <h2>Telefones Inseridos</h2>
            <ol>
                <?php
                    foreach($array as $chave){
                        echo "<li>$chave</li>";
                    }
                ?>
            </ol>

        <?php
            }
        ?>
        </div>
        <?php include_once("footer.php");  ?>
    </body>

    </html>