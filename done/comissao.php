<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('industria');
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Controle de comissão</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="comissao.css">
</head>

<body>
<div class="cabecalho"> 
        
    <button class="botao_list"onclick="openDrawer()"> <img src="./list_ico2.png" width="35" height="35"></button>
    <center> Gestão de Comissão </center>
</div>
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
    <div class="container">
        <div class="row">
        <div class="drawer" id="drawer">
            <ul>
            <form action="comissao.php" method="POST">
                <input type="text" name="cod" id="cod" placeholder="Codigo..." class="span4"
                    style="margin-top: 4px; height: 25px;">
                <input type="text" name="nome" id="nome" placeholder="Nome..." class="span4"
                    style="margin-top: 4px; height: 25px;">
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large"
                    style="height: 35px;color:white; background-color:#662e9b;">Pesquisar</button>
                        
                </form>
            </ul>
        </div>
            <br>
            
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Total venda</b></td>
                    <td><b>Comissão 10%</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar'])) {
                    $nome = strtoupper($_POST['nome']); // converter maiuscula
                
                    $consulta = "select fc.cod 'cod', fc.nome 'nome', sum(pd.quantidade * pd.preco) 'total', sum(pd.quantidade * pd.preco * 0.1) 'comissao' from funcionarios fc, pedidos pd
                                where fc.cod = pd.codfunc";
                    if ($_POST['cod'] !== '') {
                        $consulta = $consulta . " and fc.cod = ".$_POST['cod'];
                    }
                    else if ($_POST['nome'] !== '') {
                        $nome = strtoupper($_POST['nome']); // converter maiuscula
                        $consulta = $consulta . " and upper(fc.nome) like '$nome'";
                    }
                    $consulta = $consulta . ' group by pd.codfunc';

                    $resultado = mysql_query($consulta);
                } else {
                    $consulta = "select fc.cod 'cod', fc.nome 'nome', sum(pd.quantidade * pd.preco) 'total', sum(pd.quantidade * pd.preco * 0.1) 'comissao' from funcionarios fc, pedidos pd
                        where fc.cod = pd.codfunc group by pd.codfunc";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado)) {
                    $minima = 25;
                    ?>
                    <tr>
                        <td>
                            <?php echo $dados['cod']; ?>
                        </td>
                        <td>
                            <?php echo $dados['nome']; ?>
                        </td>
                        <td>
                            <?php echo "R$ ".$dados['total']; ?>
                        </td>
                        <td>
                            <?php echo "R$ ".$dados['comissao']; ?>
                        </td>
                    </tr>
                    <?php
                }
                mysql_close($conectar);
                ?>
            </table>
        </div>
    </div>
    <!-- Biblioteca requerida -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>