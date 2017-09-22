<?php
$home = new home;
if(!isset($_SESSION['user'])){
    session_start();
}