<?
session_start();
require('classes.php');
$model = new Model();
if(isset($_SESSION['player'])){
	$res = parse::count_results($model->get_answers($_SESSION['player_id']));
}else{
	header('Location: index.php');
}
?>
<!doctype html>
<html>
<head>
	<title>Testa uzdevums</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	<div class="container-fluid">
		<div class="row first_page">
			<div class="col">
				<form class="main_form test_form">
					<h2>Paldies, <span class="name"><?=$_SESSION['player']?></span>!</h2>
					<div class="alert alert-success" role="alert">
						Tu atbildēji pareizi uz <span class="par_jaut"><?=$res[1]?></span> no <span class="kopa_jaut"><?=$res[0]?></span> jautājumiem.
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>