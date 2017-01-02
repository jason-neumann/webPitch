<?php
$controller = new \Controllers\Ajax();
$action = $_POST['action'];
$controller->$action();