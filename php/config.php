<?php

require_once "USER.php";



$server='localhost';
$dbname='';
$password='';
$user='';

try{
    $connexion=new PDO("mysql:host=$server;dbname=$dbname",$user,$password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { 
    echo "la connection a echoué !: ". $e->getMessage();
}
