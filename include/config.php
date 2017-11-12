<?php

/* Dados para conexão com o banco de dados
$host       =	"sistemaagenda.mysql.dbaas.com.br";
$database   =	"sistemaagenda";
$user       =	"sistemaagenda";
$pass       =	"sis@2535";
*/

$host       =	"mysql.3rinfo.com.br:3306";
$database   =	"3rinfo07";
$user       =	"3rinfo07";
$pass       =	"r17197929";

$conn = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($database);

foreach ($_REQUEST as $key=>$val) {
    ${$key}=$val;
}

 // Variavéis Globais

$hoje       = date("Ymd"); 
$data       = date("d-m-Y");
$datahora   = date("Ymd H:i:s"); 
$ghora      = date("H:i"); 

?>
