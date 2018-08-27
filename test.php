<?
session_start();
require('classes.php');
$model = new Model();
if(isset($_SESSION['question_ids'])){
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="js/main.js?v=<?=time()?>"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row first_page">
			<div class="col">
				<form class="main_form test_form">
					<h2 class="question"></h2>
					<br/>
					<div class="magick"></div>
					<div class="progress">
					  <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
					</div>
					</br/>
					<button type="submit" class="btn btn-primary check_jaut">Nākamais jautājums</button>
					<div class="alert alert-danger jaut_error" role="alert" style="display:none;">
						Jums ir jāizvēlās vismaz viens atbilžu variants !
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>