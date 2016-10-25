<?php if(!isset($_SESSION['userId'])) { ?>
<a href='signup.html'>sign up</a><br/>
<a href='login.php'>log in</a>
<?php } else { ?>
<a href='teamSelection.php'>Select a teammate</a>
<?php } ?>
