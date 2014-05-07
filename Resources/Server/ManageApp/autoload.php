<?php
function __autoload($class_name) {
	$class_name = str_replace('_', '/', $class_name);
	include $class_name . '.php';
}