<?php
if($_POST['estado']){
setcookie('uf', "{$_POST['uf']}", time()+3600*24, "/");
setcookie('estado', "{$_POST['estado']}", time()+3600*24, "/");

    $estado = $_POST['estado'];
$filename = "../pages/{$estado}.php";
if (!file_exists($filename)) {
    copy("../pages/estadoatual.php", $filename);
}
header("Location: ../{$estado}");
}else{
    setcookie('cidade', "{$_POST['cidade']}", time()+3600*24, "/");
    setcookie('ano', "{$_POST['ano']}", time()+3600*24, "/");

    $cidade = $_POST['cidade'];
    $ano = $_POST['ano'];

    $filecity = "../pages/{$cidade}.php";
if (!file_exists($filecity)) {
    copy("../pages/cidadeatual.php", $filecity);
}
    header("Location: ../{$_COOKIE['estado']}/{$cidade}");
}
?>