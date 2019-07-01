<div class="navbar">
        <?php
            if(isset($_SESSION["id"])){
                $usuario = new UsuarioDao();
                $id = $_SESSION["id"];
                $dado = $usuario->find($id);
        ?>
            <ul class="text-decoration inline-block-left">
                <li class="nav-item-login">Olá, <?php  echo($dado->nome); ?></li>
            </ul>
        <?php
            }
        ?>
        <ul class="text-decoration inline-block-right">
            <?php
                if(isset($_SESSION["id"])){    
            ?>
                <li class="nav-item"><a href="crudUsuario.php">Usuários</a></li>
                <li class="nav-item"><a href="listaContatos.php">Contatos</a></li>
                <li class="nav-item"><a href="relatorios.php">Relatórios</a></li>
                <li class="nav-item" style="margin-right: 50px;"><a href="crudTipoContato.php">Tipo de Contato </a></li>
                <li class="nav-item"><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
            <?php
            }else{
            ?>
                <li class="nav-item-login"><a href="formcadusuario.php">Cadastre-se <i class="fas fa-plus"></i></a></li>
                <li class="nav-item-login"><a href="login.php">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php
            }
            ?>
        </ul>
    </div>