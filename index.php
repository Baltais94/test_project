<?
require('classes.php');
$model = new Model();

//validate submited form and set session variables
if($_SERVER["REQUEST_METHOD"] == 'POST') {
	//validation check
	$register = $model->register_player(
		array(
			'name'		=>	validation::input($_POST['name']),
			'test_id'	=> 	validation::input($_POST['test_id'])
		)
	);
	//Start session and redirect to test view
	if($register){
		session_start();
		$_SESSION['question_ids'] = $model->get_data($_POST['test_id']);
		$_SESSION['current'] = 0;
		$_SESSION['player'] = $_POST['name'];
		$_SESSION['player_id'] = $register;
		$_SESSION['count'] = $model->return_count($_POST['test_id']);
		header('Location: test.php');
	}
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
	<script src="js/main.js?v=<?=time()?>"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row first_page">
			<div class="col">
				<form class="main_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<h2>Testa uzdevums</h2>
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Ievadi savu vārdu">
					</div>
					<select name="test_id" class="form-control">
						 <option value="-1">Izvēlies testu</option>
						<?$tests = $model->select();
						  foreach($tests as $test){
							echo '<option value="'.$test['id'].'">'.$test['name'].'</option>';
						  }?>
					</select>
					<br/>
					<button type="submit" class="btn btn-primary start">Sākt testu</button>
					<div class="alert alert-danger jaut_error" role="alert" style="display:none;">
						Jums ir obligāti jāievada vārds un jāizvēlās tests!
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>