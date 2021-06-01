<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

if (session_status() != PHP_SESSION_ACTIVE)
	session_start();

define('ROK_AKADEMICKI', (date('Y') - 1) . '/' . date('Y'));

require_once 'vendor/autoload.php';

use Ibd\Uzytkownicy;

if (!empty($_POST['login'])) {
	$uzytkownicy = new Uzytkownicy();

	if ($uzytkownicy->zaloguj($_POST['login'], $_POST['haslo'], 'administrator')) {
		header("Location: admin.index.php");
		exit();
	} else {
		$blad = 1;
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Internetowe Bazy Danych</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Bootstrap core CSS -->
	<link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: auto;
		}

		.form-signin .form-control {
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}

		.form-signin .form-control:focus {
			z-index: 2;
		}

		.form-signin input[type="login"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="haslo"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>

<body class="text-center">
	<form class="form-signin" method="post" action="">
		<?php if(!empty($blad)): ?>
			<p class="alert alert-danger">Wprowadzono niepoprawny login bądź hasło.</p>
		<?php endif; ?>

		<h1 class="h3 mb-3 font-weight-normal">Logowanie</h1>

		<label for="login" class="sr-only">Login</label>
		<input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
		<label for="haslo" class="sr-only">Hasło</label>
		<input type="password" id="haslo" name="haslo" class="form-control" placeholder="Hasło" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj się</button>

		<p class="mt-5 mb-3 text-muted">Internetowe Bazy Danych</p>
	</form>
</body>

</html>