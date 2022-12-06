<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    if(!$_GET){
        echo("<title>");
        echo("Feriados Nacionais, Estaduais e Municipais no Brasil 2022");
        echo("</title>");
    }
    ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-unic.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .flex{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
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
    font-size: 1.5rem;
    text-align: center;
    padding:1rem 1.2rem;
    text-decoration:none;
}
.cidade:hover,.estado:hover{
    background-color:#d1d1d1;
}

.a_hover:hover{
    color:#5E0D72;
    text-decoration:none;
    background-color: #d1d1d1;
}
._table{
    margin: 1.5rem 0.5rem 0rem 0.5rem;
}
.cidade{
    width: 23rem;
    color:#5E0D72;
    background-color: #f0f0f0;
    font-size: 1.5rem;
    text-align: center;
    padding:1rem 1.2rem;
    text-decoration:none;
}
.dia{
    background-color: #f0f0f0;
    font-size: 2rem;
    padding: 5px 25px;
    margin-top: 1.5rem;
    color: #5E0D72;
}
a{
    color:#5E0D72;
}
#search{
    width:20rem;
    height:3.5rem;
    background-color: #7A398A;
    color:#fff;
    margin:1rem;
    border:1px solid #7a398a;
    border-radius:8px;

}
#search:hover{
    background-color:#8e43a1;
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