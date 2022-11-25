<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Feriados</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-unic.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
#semana, #cidades{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
}
#estados{
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
    border-top: solid 1px black;
}
.estado{
    width: 18rem;
    background-color: #f0f0f0;
    font-size: 2rem;
    margin: 1.5rem 0.5rem 0rem 0.5rem;
}
.cidade{
    width: 23rem;
    background-color: #f0f0f0;
    font-size: 2rem;
    margin: 1.5rem 0.5rem 0rem 0.5rem;
}
.dia{
    background-color: #f0f0f0;
    font-size: 2rem;
    padding: 5px 25px;
    margin-top: 1.5rem;
}
a{
    color:#5E0D72;
}
    </style>
</head>
<body>
<header class="container grande" style="background-color:#5e0d72 ; color: #fff ; margin: 0px 0px">
        <h1 class="text-center h1 " style="font-size: 5rem">Feriados do Brasil</h1>
        <div id="menu"></div>
    </header>
<?php
include_once "php/regeex.php";
if($_GET){
$url = explode('/', $_GET['url']) ?? 'home';
$tam = sizeof($url);

if($tam > 2){
    require_once "pages/".$url[2].".php";
}else if($tam > 1){
    require_once "pages/".$url[1].".php";
}else{
require_once "pages/".$url[0].".php";
}
}else{
    require_once "pages/home.php";
}
?>
<script>$(document).ready(function() {
    $('#cidades').select2();
});</script>
</body>
</html>