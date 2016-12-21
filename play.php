<pre><?php
/**
 * create the game controller
 * 
 */
$controller = new \Controllers\Game($_GET['gameId']);
$controller->render();