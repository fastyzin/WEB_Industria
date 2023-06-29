<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('industria');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>Controle financeiro</title>
        <link rel="stylesheet" href="financeiro.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
    <div class="cabecalho"> 
        <button class="botao_list"onclick="openDrawer()"> <img src="./list_ico2.png" width="35" height="35"></button>
        <center> Gestão de financeiro </center>
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
                <form action="pedidos.php" method="POST">
                        <div class="searchCategory">
                            <h5>Período: </h5>
                            <input type="date" name="dataInicial" id="dataInicial" placeholder="Data inicial"class="span4"
                                style="margin-bottom: -2px; height: 25px;">
                            <input type="date" name="dataFinal" id="dataFinal" placeholder="Data Final"class="span4"
                                style="margin-bottom: -2px; height: 25px;">
                        </div>
                        <div class="searchCategory">
                            <h5>Funcionário: </h5>
                            <input type="text" name="funcionario" id="funcionario" placeholder="Nome do funcionário"class="span4"
                                style="margin-bottom: -2px; height: 25px;">
                        </div>
                        <div class="searchCategory">
                            <h5>Cliente: </h5>
                            <input type="text" name="cliente" id="cliente" placeholder="Nome do cliente"class="span4"
                                style="margin-bottom: -2px; height: 25px;">
                        </div>
                        <div>
                            <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large"
                                style="height: 35px; margin-top: 12px;background-color: #662e9b;color:white;">Pesquisar</button>
                        </div>
                    </form>
                            
                    </form>
            </ul>
        </div>
                <br>
                <table border="1px" bordercolor="gray" class="table table-stripped">
                    <tr>
                        <td><b>Cod</b></td>
                        <td><b>Data pedido</b></td>
                        <td><b>Funcionário</b></td>
                        <td><b>Cliente</b></td>
                        <td><b>Total pedido R$</b></td>
                    </tr>
                    <?php
                    if (isset($_POST['pesquisar'])) {
                        $consulta = "select pd.cod 'cod', pd.datapedido 'data', fc.nome 'funcionario', cl.nome 'cliente', sum(pd.quantidade * pd.preco) 'total' from clientes cl, funcionarios fc, pedidos pd
                            where pd.codfunc = fc.cod and pd.codcli = cl.cod ";

                        if ($_POST['dataInicial'] !== '') {
                            $consulta = $consulta . 'and pd.datapedido >= "'.$_POST['datainicial'].'" ';
                        }
                        if ($_POST['dataFinal'] !== '') {
                            $consulta = $consulta . 'and pd.datapedido <= "'.$_POST['dataFinal'].'" ';
                        }
                       
                        if ($_POST['funcionario'] !== '') {
                            $consulta = $consulta . 'and fc.nome LIKE "%'.$_POST['funcionario'].'%" ';
                        }
                        if ($_POST['cliente'] !== '') {
                            $consulta = $consulta . 'and cl.nome LIKE "%'.$_POST['cliente'].'%" ';
                        }

                        $consulta = $consulta . "group by cl.nome";

                        $resultado = mysql_query($consulta);
                    } else {
                        $consulta = "select pd.cod 'cod', pd.datapedido 'data', fc.nome 'funcionario', cl.nome 'cliente', sum(pd.quantidade * pd.preco) 'total' from clientes cl, funcionarios fc, pedidos pd
                        where pd.codfunc = fc.cod and pd.codcli = cl.cod group by cl.nome";
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
                                <?php echo implode('/', array_reverse(explode('-', $dados['data']))); ?>
                            </td>
                            <td>
                                <?php echo $dados['funcionario']; ?>
                            </td>
                            <td>
                                <?php echo $dados['cliente']; ?>
                            </td>
                            <td>
                                <?php echo $dados['total']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <h3>
                    <?php
                        $totalGeral = -1;
                        $consultaGeral = "select sum(total) 'total' from (select sum(quantidade * preco) 'total' from pedidos group by codcli) A";
                        $resultadoGeral = mysql_query($consultaGeral);
        
                        while($dados = mysql_fetch_array($resultadoGeral)) {
                            $totalGeral = $dados['total'];
                        }
                        mysql_close($conectar);
                    ?>
                    Total geral: R$ <?php echo $totalGeral ?>
                </h3>
            </div>
        </div>
        <!-- Biblioteca requerida -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
