<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

define('ROK_AKADEMICKI', (date('Y') - 1) . '/' . date('Y'));

require_once 'vendor/autoload.php';

use Ibd\Menu;

$liczbaKsiazekWKoszyku = 0;
$koszykHtml = "<span class='badge badge-dark' id='wKoszyku'>$liczbaKsiazekWKoszyku</span>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Internetowe Bazy Danych <?= ROK_AKADEMICKI ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="navbar-brand" href="index.php">
					<i class="fas fa-book"></i>
					IBD
				</a>
                <ul class="navbar-nav mt-2 mt-lg-0">
					<?= Menu::generujOpcje('index.php', 'Strona główna') ?>
                    <?= Menu::generujOpcje('ksiazki.lista.php', 'Książki') ?>
                    <?= Menu::generujOpcje('koszyk.lista.php', "Koszyk $koszykHtml") ?>
                </ul>
            </div>
        </nav>
    </div>
	
    <div class="container">
        <div class="row">
            <div class="col-md-10"> 