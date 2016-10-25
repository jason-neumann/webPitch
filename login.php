<?php
if(isset($_SESSION['userId'])) {
	header('Location:index.php');
	exit;
}

$username = $errorMsg = '';

	if(count($_POST)) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$statement = Utils::$db->prepare("SELECT id FROM users WHERE name = :username AND password = :password");
		$statement->execute(array(':username' =>$username, ':password' => $password));
		$id = $statement->fetchColumn();
		if($id) {
			$_SESSION['userId'] = $id;
			header('Location:index.php');
			exit;
		} else {
			$errorMsg = 'Unable to find a user matching those credentials. Please try again.';
		}
	}
?>
<! DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>
<body>
<h3>Login</h3>
<form method=post action='login.php'>
Username: <input type=text id=username name=username value="<?php echo $username; ?>" /><br/>
Password: <input type=password id=password name=password /><br/>
<input type=submit value=Submit /><br/>
<?php if($errorMsg) { ?>
<div id=errorMsg style='color:red'>
	<?php echo $errorMsg; ?>
</div>
<?php } ?>
</form>
</body>
</html>
