<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Gerenciar Produtos </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="produtos.css">
</head>
        <script>
                function openDrawer() {

                    var drawer = document.getElementById('drawer');
                    drawer.classList.add('open');
                    }

                function closeDrawer() {
                    var drawer = document.getElementById('drawer');
                    drawer.classList.remove('open');
                    }

                    document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeDrawer();
                    }
                });
            </script>
    

<body>
    <script>
        

        function obterDadosModal(valor) {
            
            var retorno = valor.split("*");

            document.getElementById('cod').value   = retorno[0];
            document.getElementById('nome').value  = retorno[1];
            document.getElementById('quantidade').value = retorno[2];
            document.getElementById('preco').value = retorno[3];
        }
    </script>
    
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Cadastrar Produtos:</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer cadastro  -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        <input type="text" name="nome" class="span3" value="" required placeholder="Nome" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <input type="text" name="quantidade" class="span3" value="" required placeholder="quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <input type="text" name="preco" class="span3" value="" required placeholder="preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="cadastrar" style="height: 35px">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <!--Modal Alterar-->
    <div class="modal fade" id="myModalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h1>Alterar Dados:</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer alteracao -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        Código<br>   <input id="cod" type="text" name="cod" value="" readonly><br><br>
                        Nome<br>  <input id="nome" type="text" name="nome" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Quantidade<br> <input id="quantidade" type="text" name="quantidade" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preço<br> <input id="preco" type="text" name="preco" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-primary" name="alterar" style="height: 35px; background-color: #662e9b;">Alterar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal Excluir-->
    <div class="modal fade" id="myModalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h1>Excluir Produtos:</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para excluir -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        <br>
                        Codigo<br>   <input id="cod" type="text" name="cod" value="" ><br><br>
                        Nome<br>  <input id="nome" type="text" name="nome" class="span3"  value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Quantidade<br> <input id="quantidade" type="text" name="quantidade" class="span3"  value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preço<br> <input id="preco" type="text" name="preco" class="span3"  value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-danger" name="excluir" style="height: 35px; background-color: #662e9b;">Excluir</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="cabecalho">     
        <button class="botao_list"onclick="openDrawer()"> <img src="./list_ico2.png" width="35" height="35"></button>
        <center>Produtos </center>
    </div>
    <div class="container">
        <div class="row">
            <div class="drawer" id="drawer">
                    <ul>
                    <form class="drawercontent"action="produtos.php" method="POST">
                        <br>
                        <input type="text" name="nome" placeholder="Pesquisar por nome" class="span4" style="margin-bottom: -2px; height: 25px; border-radius: 5px;">
                        <br>
                        <br>
                        <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px; background-color: #06bee1;color:white; height: 35px; width: 85px;">Pesquisar</button>
                        <a href="#myModalCadastrar">
                        <button type="button" name="cadastrar" class="btn btn btn-large" data-toggle="modal" data-target="#myModalCadastrar" style="background-color: #06bee1;color:white; height: 35px; width: 85px;">Cadastrar</button></a>
                        </a>
                        <br>
                        <br>
                        <a href="#myModalExcluir" onclick="obterDadosModal('<?php echo $strdados ?>')">
                            <button type='button' id='excluir' name='excluir' class='del_button' data-toggle='modal' data-target='#myModalExcluir' style="background-color: #662e9b;color:white; height: 35px; width: 85px;">Excluir</button>
                            
                            <a href="#myModalAlterar" onclick="obterDadosModal('<?php echo $strdados ?>')">
                            <button type='button' id='alterar' name='alterar' class='edit_button' data-toggle='modal' data-target='#myModalAlterar' style="background-color: #662e9b;  color:white;height: 35px; width: 85px;">Alterar</button>
                        </a>
                    </form>
                    </ul>
            </div>

            <br>
            
            <table border="1px" bordercolor="gray" class="table ">
                <tr>
                    <td><b>Código</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Quantidade</b></td>
                    <td><b>Preço</b></td>
                  
                </tr>
                  <?php

                  if (isset($_POST['cadastrar']))
                {
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $busca = mysql_query("SELECT * FROM produtos WHERE nome = '$nome'");
                    $resultadoBusca = mysql_num_rows($busca);

                    if($resultadoBusca == 0) {
                        $sql = "insert into produtos (nome, quantidade, preco)
                                values ('$nome','$quantidade','$preco')";
                        $resultado = mysql_query($sql);
                    } else {
                        ?>
                        <script>
                            window.alert("Usuário já cadastrado!")
                        </script>
                        <?php
                    }

                }
                if (isset($_POST['alterar']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "update produtos set nome = '$nome', quantidade = '$quantidade', preco = '$preco'
                            where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['excluir']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "delete from produtos where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }

                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula

                   $consulta = "select cod,nome,quantidade,preco from produtos
                                where UPPER(nome) like '%$nome%'";

                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select cod,nome,quantidade,preco from produtos";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['nome'] . "*" . $dados['quantidade'] . "*" . $dados['preco'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo $dados['preco']; ?></td>
                        

                        

                        
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
