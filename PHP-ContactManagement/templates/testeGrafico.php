

<?php
    require_once '../classes/DAO/contatoDao.php';

    session_start();

    if(isset($_SESSION["array"]))
        unset($_SESSION["array"]);

    $qtddtipo = array();
    $nome = array();
    $i = 0;
    $produtos = new ContatoDao();

    foreach($produtos->graficoTeste() as $chave => $tipo):
        $qtddtipo[$i] = $tipo->qtddtipo;
        $nome[$i] = $tipo->nome;
        $i = $i + 1;
    endforeach;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>

<head>
    <meta charset="UTF-8">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="../_css/estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
		<script type="text/javascript"> 
			google.load('visualization', '1', {'packages':['corechart']}); 
			google.setOnLoadCallback(desenhaGrafico); 
			function desenhaGrafico() { 
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Tipo do contato'); 
				data.addColumn('number', 'Quantidade de contatos'); 
				data.addRows(<?php echo $i ?>); 
				<?php 
				$k = $i; 
				for ($i = 0; $i < $k; $i++) { 
					?> 
					data.setValue(<?php echo $i ?>, 1, <?php echo $qtddtipo[$i] ?>); 
					data.setValue(<?php echo $i ?>, 0, '<?php echo $nome[$i] ?>'); 
					<?php 
				} ?> 
				var options = { title: 'Tipos de contatos mais utilizados', width: 600, height: 500, colors: ['BLUE'], legend: { position: 'bottom' } }; 
				// cria grafico 
				var chart = new google.visualization.LineChart(document.getElementById('chart_div')); 
				// desenha grafico 
				chart.draw(data, options); 
			} 
		</script> 
</head>

<body>
    <?php include_once("navbar.php");  ?>

        <h1 style="margin-top: 70px;">grafico</h1>
        <div>

        </div>
        <div id="chart_div"></div> 

    <?php include_once("footer.php");  ?>
</body>

</html>






