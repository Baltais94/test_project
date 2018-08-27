<?
//Create Database connection and display if any errors
class dbo {
	//Connection params
	protected $host = "localhost";
	protected $dbname = "test_db";
	protected $user = "root";
	protected $pass = "";
	protected $dbh;
	
	function __construct(){
		try {
			$this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}
}
//Class for selecting,updating and inserting queries
class model extends dbo{
	//Selects all from table users
	public function select(){
		$sth = $this->dbh->query("SELECT * FROM tests");
		$sth = $sth->fetchAll();
		return $sth;
	}
	//Gets answers by question id
	public function select_answers($q_id){
		$sth = $this->dbh->prepare("SELECT * FROM answers WHERE question_id=:q_id");
		$sth->bindParam(":q_id",$q_id,PDO::PARAM_INT);
		$sth->execute();
		$sth = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $sth;
	}
	//Gets question by question id
	public function select_question($q_id){
		$sth = $this->dbh->prepare("SELECT * FROM questions WHERE id=:q_id");
		$sth->bindParam(":q_id",$q_id,PDO::PARAM_INT);
		$sth->execute();
		$sth = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $sth;
	}
	//Registers player and  returns player id
	public function register_player($data){
		$stmt = $this->dbh->prepare("INSERT INTO users (name,test_id) VALUES (:name,:test_id)");
		$stmt->bindParam(":name",$data['name']);
		$stmt->bindParam(":test_id",$data['test_id']);
		$stmt->execute();
		$id = $this->dbh->lastInsertId();
		return $id;
	}
	
	//Updates user answers
	public function update_user($data,$user_id){
		$stmt = $this->dbh->prepare("UPDATE users SET answers=:data WHERE id=:user_id");
		$stmt->bindParam(":data",$data);
		$stmt->bindParam(":user_id",$user_id);
		$stmt->execute();
		return $stmt;
	}
	//Retrieves user answers by user id
	public function get_answers($user_id){
		$sth = $this->dbh->prepare("SELECT answers FROM users where id=:user_id");
		$sth->bindParam(":user_id",$user_id);
		$sth->execute();
		$sth = $sth->fetch(PDO::FETCH_ASSOC);
		return $sth;
	}
	//Gets question by test id
	public function get_data($test_id){
		$sth = $this->dbh->prepare("SELECT id FROM questions where test_id=:test_id");
		$sth->bindParam(":test_id",$test_id,PDO::PARAM_INT);
		$sth->execute();
		$sth = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $sth;
	}
	//Gets user answer count
	public function return_count($test_id){
		$sth = $this->dbh->prepare("SELECT count(*) FROM questions where test_id=:test_id");
		$sth->bindParam(":test_id",$test_id,PDO::PARAM_INT);
		$sth->execute();
		$sth = $sth->fetchColumn();
		return $sth;
	}
}
class validation {
	//Valides user input from form and returns formated data
	public static function input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
class parse {
	//Parses the data to get (1)s for total count
	public static function count_results($data){
		$temp = 0;
		//Total questions
		$res[] = count(json_decode($data['answers']));
		
		//Answers with (1) true
		foreach(json_decode($data['answers'],true) as $ans){
			if($ans['answer'] == 1){
				$temp++;
			}
		}
		$res[] = $temp;
		return $res;
	}
}