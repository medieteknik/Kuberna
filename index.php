<?php
// we require login!
define('REQIRE_LOGIN', true);

// load system
require_once 'system.php';

// get nominee data
$datafile = file_get_contents('data/nominees.json');
$data = json_decode($datafile);
?>
<!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Kuberna - Medietekniksektionen</title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <!-- CSS files -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" />

        <style>
        body {
        }
        h1, h2 {
        }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Kuberna</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        <?php
                        do_dump($data);
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        Kuberna är ett årligt tvådelat pris som delas ut till studenter vid
                        Civilingenjör i medieteknik-programmet på Linköpings Universitet.
                    </p>
                    <p>
                        Priset består av två kuber – en grå för teknisk prestation och en orange
                        för kreativitet. Nytt för i år är att du som medlem i sektionen kan rösta
                        på det bidrag du tycker ska vinna.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Grå kuben <small> nominerade</small></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>Orange kuben</h2>
                </div>
            </div>
            <?php
                if(!phpCAS::isAuthenticated())
                {
                    echo '<p>Not logged in! No vote.</p>';
                }
                else
                {
                    echo '<p>the user\'s login is <strong>' . phpCAS::getUser() . '</strong>. Vote!</p>';
                }
            ?>
            <p>
                <a href="?<?php echo phpCAS::isAuthenticated() ? 'logout' : 'login'; ?>">
                    <?php echo phpCAS::isAuthenticated() ? 'logout' : 'login'; ?>
                </a>
            </p>
        </div><!-- end .container -->
    </body>
</html>
