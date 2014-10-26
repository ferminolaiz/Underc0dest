<?php
	if(is_file('underc0dest.class.php'))
		require_once 'underc0dest.class.php';
	else
		exit;

	if(isset($TestName) && isset($Answers))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$TestName?> | Underc0de</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" media="all" href="resources/style.css">
		<script src="resources/underc0dest.js"></script>
	</head>
	<body>
		<div align="center">
			<a href="http://undercde.org/foro/" title="Volver al foro...">
				<img src="http://underc0de.org/foro/Themes/underblack/images/theme/logo.png">
			</a>
			<hr>
		</div>
		<h1><?=$TestName ?></h1>
		<div id="flotante">
			<img id="HideBoxImg" src="resources/close.png" onClick="HideBox()">
			<p>Mas que una comunidad informática Underc0de es una gran familia de la que formas parte fundamental, aquí las ideas fluyen libres, los conocimientos van y vienen en todas direcciones, pero necesitamos de ti para hacerlo posible. Anímate completando el siguiente ********** (formulario, test, examen, no se...) Te sonríes un poco y al mismo tiempo nos ayudas a enfocar nuestros materiales en beneficio de ustedes los underc0ders.</p>
			<a href="http://underc0de.org/" title="Volver al foro...">Volver al foro...</a>
		</div>
<?php
		$E = new Underc0dest($TestName, $Answers);

		if($E::__Utils__CheckPOSTVars())
		{
			$R = $E->Check
			(
				array
				(
					$_POST['0'],
					$_POST['1'],
					$_POST['2'],
					$_POST['3'],
					$_POST['4'],
					$_POST['5'],
					$_POST['6'],
					$_POST['7'],
					$_POST['8'],
					$_POST['9']
				)
			);

			if($R === -1)
				header("Location: {$_SERVER['REQUEST_URI']}");

			if(isset($R['points']) && isset($R['errors']))
			{
?>
		<script src="resources/stardust.js"></script>
		<h3>Puntaje: <?=$R['points']?>/10</h3>
<?php
				if($R['points'] == 10 && $R['errors'] === array())
				{
?>
		<h4>¡Felicitaciones! No has cometido ningún error</h4>
<?php
				}
				else
				{
?>
		<h4>Has cometido algunos errores: </h4>
<?php
					foreach($R['errors'] as $Error)
					{
?>
		<br>
		<?=$Error[0] + 1?>. <?=$Error[1]?><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Has respondido: <?=$Error[2]?><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Respuesta correcta: <?=$Error[3]?><br>
<?php
					}
				}
			}
			else
				header("Location: {$_SERVER['REQUEST_URI']}");
		}
		else
		{
?>
		<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
<?php
				$ic = count($Answers);
				for($i = 0; $i < $ic; $i++)
				{
?>
			<h3><?=$Answers[$i]['q']?></h3>
<?php
					$jc = count($Answers[$i]['r']);
					for($j = 0; $j < $jc; $j++)
					{
?>
			<input type="radio" name="<?=$i; ?>" value="<?php echo $j; ?>">&nbsp;<?php echo $Answers[$i]['r'][$j]?><br>
<?php
					}
				}
?>
			<input type="submit" name="submit" value="Listo!">
		</form>
<?php
		}
	}
	else
		exit;
?>
</body>
</html>