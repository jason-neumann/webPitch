<?php
	$statement = Utils::$db->prepare(
		"INSERT INTO games "
			  . "(player1Id, player2Id, player3Id, player4Id) "
			  . "VALUES "
			  . "(:player1, :player2, :player3, :player4)"
	);
	echo $statement->execute(array(
		 ':player1' => $_POST['team1'][0],
		 ':player2' => $_POST['team1'][1],
		 ':player3' => $_POST['team2'][0],
		 ':player4' => $_POST['team2'][1]
	));
?>