<?php
$js = array('/statics/teamSelection.js');
require VIEWS . 'header.phtml';
?>
<body>
	<?php
	echo 'Hello ' . Utils::$userInfo['name'] . '<br/>';
	echo 'Please choose your teammate for the game:<br/><div class=teamSelection>';
	$statement = Utils::$db->prepare(
			"SELECT id,name FROM users WHERE id != :id ORDER BY name"
	);
	$statement->execute(array(':id' => $_SESSION['userId']));
	?>
	<div class="box availableUsers">
		Available Players
		<?php
		foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $user) {
			?>
			<div data-id='<?php echo $user['id'] ?>' class='user'>
				<?php echo $user['name'] ?>
				<span class="fa fa-arrow-circle-right add"></span>
			</div>
		<?php } ?>
	</div>
	<div class="box team1">
		Team 1
		<div data-id='<?php echo $_SESSION['userId'] ?>' class='user'>
			<?php echo Utils::$userInfo['name'] ?>
		</div>
		<div class='user empty'></div>
	</div>
	<div class="box team2">
		Team 2
		<div class='user empty'></div>
		<div class='user empty'></div>
	</div>
</div>
<div class='box submit'>
	Create Game!
</div>
</body>
</html>