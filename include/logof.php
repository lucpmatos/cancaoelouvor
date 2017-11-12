<?
session_start();
session_destroy();
$s="../login.html";
Header("Location: ".$s);
?>