<?php
// recup la requete le A et le R
// Un seul controller à créer => scoreController
// Model=> fAll fFind fSave
// model score => fTopScore (meme que fAll mais trié)
//
// pas de view
//
// fSave => requete sql insert into table (..., ..., ...) values(..., ..., ...)
//
// $score = [
//     ['score'=>22, 'creater_at'=>56432],
//     ['score'=>22, 'creater_at'=>56432]
// ];
//
// echo json_encode($score);

require 'vendor/autoload.php';

include( 'routes.php' );

$m = $_SERVER[ 'REQUEST_METHOD' ];
$a = isset( $_REQUEST[ 'a' ] ) ? $_REQUEST[ 'a' ] : 'index';
$r = isset( $_REQUEST[ 'r' ] ) ? $_REQUEST[ 'r' ] : 'score';
// var_dump( $_SERVER[REQUEST_METHOD] );

if ( !in_array( $m.'_'.$a.'_'.$r, $routes ) ){
    die( 'We couldn\'t find the page you asked...' );
}

$controller_name = '\Controller\\'.ucfirst( $r ).'Controller';
$controller = new $controller_name;

$datas = call_user_func( [ $controller, $a ] );

echo json_encode( $datas );
