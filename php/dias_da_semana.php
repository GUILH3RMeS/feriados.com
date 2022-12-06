<?php
include_once('cookies.php');
$uf = $uf;
$estado = $estado_url;
$cidade = $cidade_url;
$calendario = "https://www.transportal.com.br/feriados/$uf/$cidade";
$request_municipio = file_get_contents($calendario);
preg_match_all('/<h2 class="nome-do-feriado">(.*?)<\/h2>/', $request_municipio, $dn);
preg_match_all('/<div class="div-feriado-individual">(.*?)<\/div>/', $request_municipio, $tf);
$tfs = implode($tf[0]);
preg_match_all('/<div>(.*?)<\/div>/', $tfs, $tff);
preg_match_all('/(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}/', $request_municipio, $data_feriados);
// captura o tipo do feriado e remove as tags html
$tipo_feriados = [];
foreach($tff[0] as $key => $value){
    $value = explode('>',$tff[0][$key]);
    $value = explode('<',$value[1]);
    array_push($tipo_feriados, $value[0]);
}
//remove o nome da data
$temp = implode($data_feriados[0]);
preg_match_all('/\/[01][0-9]\//', $temp, $m);
foreach($m as $key => $value){
$mes = str_replace('/', ' ', $value);
}
// armazem do nome e data
$datanome_feriados = [];
$nome_feriados = [];
// remove as tags html da data e nome
foreach($dn[0] as $key => $value){
    $value = explode('>',$dn[0][$key]);
    $value = explode('<',$value[1]);
    array_push($datanome_feriados, $value[0]);
}
// separa a data do nome em array's
foreach($dn[0] as $key => $value){
    $value = explode(' - ',$dn[0][$key]);
    $value = explode('<',$value[1]);
    array_push($nome_feriados, $value[0]);
}

//conversor dia inglês para português
$semana_eng = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

$semana_br = [
    'Sun' => 'Dom', 
    'Mon' => 'Seg',
    'Tue' => 'Ter',
    'Wed' => 'Qua',
    'Thu' => 'Qui',
    'Fri' => 'Sex',
    'Sat' => 'Sab' 
];

//pegar data atual do sistema
date_default_timezone_set('America/Sao_Paulo');
$atual_my = date("m/Y");
$atual_d = 2;
$atual_day = "Fri";
//pegar data dos sete dias apartir de domingo (Sun / Dom)
$semana_eng_length = sizeof($semana_eng);
$semana = [];
for($i = 0 ; $i < $semana_eng_length ; $i++){
    if($semana_eng[$i] === $atual_day){
        $d = $atual_d - $i;
        if(){
            
        }
        array_push($semana,$d);
    }
}
for($i = 0 ; $i < $semana_eng_length ; $i++){
    array_push($semana, $semana[$i]+1);
}
array_pop($semana);
print_r($semana);
?>