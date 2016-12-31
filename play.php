<?php
$controller = new \Controllers\Game($_GET['gameId']);
$controller->render();