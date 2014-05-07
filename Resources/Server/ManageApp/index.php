<?php
session_start();
ob_start();

include_once 'autoload.php';

if (isset($_GET['logout']) && $_SESSION['logged_in'] == true) {
	session_destroy();
	ob_clean();
	header('Location: index.php?logged_out');
}

$database = new Classes_UseDatabase();

$super_admins = array(
	'Matthew Kerle' => 'd66d25ccf53f6b8c7becb8c2ee9db2f1c7434179',
	'Jay Mercer' => 'efa132d6dcfecf174963f846c7befe698d076dfb',
);

if (!empty($_POST['username']) && !empty($_POST['password'])) {
	if (array_key_exists($_POST['username'], $super_admins) && $super_admins[$_POST['username']] == sha1($_POST['password'])) {
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $_POST['username'];
	}
}

if ($_SESSION['logged_in'] == true) {
	$userClass = new Classes_User($_SESSION['username']);
	$user['is_logged'] = true;
}

if ($user['is_logged']) {
	//-- A page "autoloader".
	if ($_REQUEST['page'] == 'login') {
		ob_clean();
		header('Location: index.php?page=main&logged_in=true');
	}
	if (!empty($_REQUEST['page'])) {
		// Strip it apart...
		$class_name = 'Pages_' . str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($_REQUEST['page']))));
		if (class_exists($class_name)) {
			$page = new $class_name($database);
		}
	} else {
		ob_clean();
		header('Location: index.php?page=main');
	}
} else if (!empty($_REQUEST['page']) && $_REQUEST['page'] == 'login') {
	$page = new Pages_Login();
} else {
	ob_clean();
	header('Location: index.php?page=login');
}

echo '
<!DOCTYPE html>
<html>
	<head>
		<title>', $page->titleUrl(), '</title>
		<meta charset="utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Englebert" rel="stylesheet" type="text/css">
		<link href="CSS/main.css" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		', $page->head(), '
	</head>
	<body>
		', $page->prepend(), '
		<div id="header">
			<h1><a href="index.php?page=main">Manage GCSA Mobile</a></h1>
			<h4>', $page->titlePage(), '</h4>
		</div>
		<div id="wrapper">
			<div class="top-line"></div>
				<div id="', $page->getWrapperId(), '_wrapper">
					', $page->content(), '
				</div>
			<div class="bottom-line"></div>
		</div>
		', $page->append(), '
	</body>
</html>
';