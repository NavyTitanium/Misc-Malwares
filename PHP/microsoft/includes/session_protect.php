<?php
session_start();
if(!isset($_SESSION['page_a_visited'])){
header("Location: https://www.office.com/");
die();
}
?>