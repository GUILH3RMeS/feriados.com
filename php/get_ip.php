<?php
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
if ($query && $query['status'] == 'success') {
    $estado = $query['regionName'];
    $cidade = $query['city'];
    $uf = strtoLower($query['region']);
}else {
    $estado_url = "sao-paulo";
}
$estado_url = sanitizeString($estado);
$estado_url = preg_replace('/[^a-z0-9]/i', '-', $estado_url);
$estado_url = preg_replace('/_+/', '-', $estado_url); // ideia do Bacco :)
$estado_url = strtolower($estado_url);

if($cidade){
$cidade_url = sanitizeString($cidade);
$cidade_url = preg_replace('/[^a-z0-9]/i', '_', $cidade_url);
$cidade_url = preg_replace('/_+/', '_', $cidade_url); // ideia do Bacco :)
$cidade_url = strtolower($cidade_url);
}
?>