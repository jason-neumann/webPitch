<?php if(!isset($_SESSION['userId'])) { ?>
<a href='signup.html'>sign up</a><br/>
<a href='login.php'>log in</a>
<?php } else { ?>
<a href='teamSelection.php'>Start a game!</a>
<h2>It's your turn</h2>
<?php
	foreach(\Models\Games::getPlayerGamesWithTeamNames($_SESSION['userId']) as $game) {
?>
		<a href="play.php?gameId=<?php echo $game['gameId'];?>">
			You and <?php echo $game['partnerName'] . ' versus ' . $game['opponents'];?> - <?php echo $game['gameState']; ?> 
		</a><br/>
<?php
	}
}
?>
