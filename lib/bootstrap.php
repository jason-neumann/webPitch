<?php
function __autoload($class) {
	require_once(getcwd() . '/lib/' . str_replace('\\','/',$class) . '.php');
}

class Utils {
	static $db;

	static $userInfo;

	public function __construct(){
		self::$db = new PDO('mysql:host=localhost;dbname=pitch','root','4rfvbgt5');
		if(isset($_SESSION['userId'])) {
			$statement = self::$db->prepare("SELECT id, name FROM users WHERE id = :id");
			$statement->execute(array(':id' => $_SESSION['userId']));
			self::$userInfo = $statement->fetch(PDO::FETCH_ASSOC);
		}
	}
}
new Utils();
