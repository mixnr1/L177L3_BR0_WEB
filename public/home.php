<?php
session_start();
include('../config/config.php');
if(strlen($_SESSION['userlogin'])==0)
{
header('location:index.php');
}
else{
include('header.php');
include('body.php');
} ?>
