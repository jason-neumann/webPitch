<?php
	$db = new PDO('mysql:host=localhost;dbname=pitch','root','4rfvbgt5');
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$statement = $db->prepare("INSERT INTO users (name, password) VALUES (:username,:password)");
	var_dump($statement->execute(array(':username' =>$username, ':password' => $password)));
