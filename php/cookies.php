<?php
include_once 'get_ip.php'; 
setcookie('uf', "$uf", time()+3600*24 ,"/");
setcookie('estado', "$estado_url", time()+3600*24 ,"/");
setcookie('cidade', "$cidade_url", time()+3600*24 ,"/");
?>