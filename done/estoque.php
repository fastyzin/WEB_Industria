<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('industria');
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Controle de estoque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="estoque.css">

</head>

<body>
<div class="cabecalho"> 
        
    <button class="botao_list"onclick="openDrawer()"> <img src="./list_ico2.png" width="35" height="35"></button>
    <center> Gestão de Estoque </center>
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

            <br>
            <div class="drawer" id="drawer">
                <ul>
                <form action="estoque.php" method="POST">
                    <input type="text" name="nome" id="nome" placeholder="Nome Produto..." class="span4"
                      style="margin-top: 5px; height: 25px; ">
                    <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large"
                     style="margin-top: 2px; height: 35px; background-color: #662e9b; color:white;">Pesquisar</button>
                     
                </form>
                </ul>
            </div>
            
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Qtde Estoque</b></td>
                    <td><b>Qtde Minima</b></td>
                    <td><b>SALDO</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar'])) {
                    $nome = strtoupper($_POST['nome']); // converter maiuscula
                
                    $consulta = "select cod,nome,quantidade from produtos
                                where UPPER(nome) like '%$nome%'";

                    $resultado = mysql_query($consulta);
                } else {
                    $consulta = "select cod,nome,quantidade from produtos";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado)) {
                    $valor = $dados['cod'] . "*" . $dados['nome'] . "*" . $dados['quantidade'];
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
                            <?php echo $dados['quantidade']; ?>
                        </td>
                        <td>
                            <?php echo $minima; ?>
                        </td> <!-- definir uma quantidade m�nima pro estoque -->
                        <td>
                            <?php $saldo = ($dados['quantidade'] - $minima);
                            if ($saldo < $minima) {
                                echo "<font color='#FF0000'>" . $saldo . "</font>";
                            } else {
                                echo $saldo;
                            }
                            ?>
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