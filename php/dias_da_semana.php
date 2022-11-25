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
$dia_s = "Thu";
$dia_n = "13";
$m_a = "10/2022";
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
$semana = [];
$ii = 0;
$semana_eng_length = sizeof($semana_eng);
for($i = 0 ; $i < $semana_eng_length ; $i++){
    if($semana_eng[$i] === $dia_s){
    $ii = $i;
    }
    }
    if($ii > 0){
        $dia_n = $dia_n - $ii;
    }
    for($i = 0 ; $i < $semana_eng_length ; $i++){
        if($dia_n < 10){
            $dia_n = "0" . $dia_n;
        }
        $temp_dia = $dia_n . "/" . $m_a ;
        $dia_n++;
        array_push($semana, $temp_dia);
    }
    $temp_dia = [];
    foreach($data_feriados[0] as $key => $value){
        for($i = 0 ; $i < $semana_eng_length ; $i++){
            if($value == $semana[$i]){
                array_push($temp_dia, $semana_eng[$i]);
            }
        }
    }
    $temp_dia_length = sizeof($temp_dia);
echo('<div id="semana" class="d-flex align-items-center flex-wrap">');
for($i = 0 ; $i < $semana_eng_length ; $i++){
    
    if($dia_s === $semana_eng[$i]){
        echo('<div class="container-fluid dia" id="dia' . "$i" . '" style="background-color: #340740 ; color: white" onmouseenter="show()">');
        echo("hoje");
        echo('</div>');
    }else{
        for($j = 0 ; $j <  $temp_dia_length ; $j++){
            if($temp_dia[$j] == $semana_eng[$i]){
                if($i == 0){
                    print_r("<div id='um' class='absolute' style='position: absolute; top: 10rem; right: 104rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 1){
                    echo("<div id='dois' class='absolute' style='position: absolute; top: 10rem; right: 91rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 2){
                    echo("<div id='tres' class='absolute' style='position: absolute; top: 10rem; right: 78rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 3){ 
                    echo("<div id='quatro' class='absolute' style='position: absolute; top: 14rem; right: 65rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray ; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 4){
                    echo("<div id='cinco' class='absolute' style='position: absolute; top: 14rem; right: 51.8rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray ; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 5){
                    echo("<div id='seix' class='absolute' style='position: absolute; top: 14rem; right: 38rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else{
                    echo("<div id='sete' class='absolute' style='position: absolute; top: 14rem; right: 11.8rem; width: 300px; height: 40px; border: 1px solid black; background-color: lightgray ; display: none' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }
                echo('<div class="container-fluid dia" id="dia' . "$i" . '" style="background-color: #7A398A; color: white" onmouseenter="show()">');
                    echo($semana_br[$semana_eng[$i]]);
                echo('</div>'); 
            }else{
                if($j > 0){
            echo('<div class="container-fluid dia" id="dia' . "$i" . '" >');
            echo($semana_br[$semana_eng[$i]]);
            echo('</div>');
                }
            }
        }
    }
}
echo('</div>');
?>