<?php
echo 'Hello ' . Utils::$userInfo['name'] . '<br/>';
echo 'Please choose your teammate for the game:<br/>';
$statement = Utils::$db->prepare(
	"SELECT id,name FROM users WHERE id != :id ORDER BY name"
);
$statement->execute(array(':id' =>$_SESSION['userId']));
foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $user) {
	echo "<a href='opponentSelection.php?teammate=" . $user['id'] . "'>" . $user['name'] . '</a><br/>';
}
