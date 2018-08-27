<?
session_start();
require('classes.php');
$model = new Model();
if($_POST['action'] == 'update'){
	$q_id = $_SESSION['question_ids'][$_SESSION['current']]['id'];
	$scores = json_decode($model->get_answers($_SESSION['player_id'])['answers'],true);
	$scores[] = array('q_id' => $q_id,'answer' => $_POST['answer']);
	$model->update_user(json_encode($scores),$_SESSION['player_id']);
	print_r($scores);
}
if($_POST['action'] == 'get_current_answ'){
	$q_id = $_SESSION['question_ids'][$_SESSION['current']]['id'];
	echo json_encode($model->select_answers($q_id));
}
if($_POST['action'] == 'get_current_q'){
	$q_id = $_SESSION['question_ids'][$_SESSION['current']]['id'];
	echo json_encode($model->select_question($q_id));
}
if($_POST['action'] == 'update_current'){
	$_SESSION['current']++;
	echo $_SESSION['current'];
}
if($_POST['action'] == 'get_count'){
	echo json_encode(array((int)$_SESSION['count'],$_SESSION['current']),true);
}