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
$atual_y = date("Y");
$atual_m = date("m");
$atual_d = date("d");
$atual_D = date("D");
$total_d = cal_days_in_month(CAL_GREGORIAN, $atual_m, $atual_y);
$domingo = 0;
//pegar data dos sete dias apartir de domingo (Sun / Dom)
$semana_eng_length = sizeof($semana_eng);
$semana = [];
for($i = 0 ; $i < $semana_eng_length ; $i++){
    if($semana_eng[$i] === $atual_D){
        $d = $atual_d - $i;
        if($d < 1){
            if($atual_m > 1){
                $total_d = cal_days_in_month(CAL_GREGORIAN, $atual_m-1, $atual_y);
                $domingo = $total_d + $d;
            }else{
                $total_d = cal_days_in_month(CAL_GREGORIAN,12, $atual_y-1);
                $domingo = $total_d + $d;
                $atual_m = 12;
                $atual_y -= 1; 
            } 
        }else{
                $domingo = $atual_d - $i;
        }
    }
}
for($i = 0 ; $i < $semana_eng_length ; $i++){
    $verify = $domingo + $i;
    if($verify <= $total_d){
    if($i == 0){
        $d = $domingo;
        if($atual_m <= 9){
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }
        }else{
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . $atual_m . '/' . $atual_y;
            }
        }
    }else{
        $d = $domingo + $i;
        if($atual_m <= 9){
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }
        }else{
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . $atual_m . '/' . $atual_y;
            }
        }
    }
}else{
    $d = $verify - $total_d;
    if($atual_m < 12){
        if($atual_m <= 9){
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . '0' . $atual_m . '/' . $atual_y;
            }
        }else{
            if($d <= 9){
                $dia_s = '0' .  $d . '/' . $atual_m . '/' . $atual_y;
            }else{
                $dia_s = $d . '/' . $atual_m . '/' . $atual_y;
            }
    }
    }else{
        if($d <= 9){
            $dia_s = '0' . $d . '/' . '01' . '/' . $atual_y+1;
        }else{
            $dia_s = $d . '/' . '01' . '/' . $atual_y+1;
        }
    }
}
    array_push($semana, $dia_s);
}
$temp_dia = [];
foreach($data_feriados[0] as $key => $value){
    for($i = 0 ; $i < $semana_eng_length ; $i++){
        if($value == $semana[$i]){
            array_push($temp_dia, $semana_eng[$i]);
        }
    }
}
foreach($temp_dia as $key => $value){
    $ii = $key+1;
if($key > 0 && isset($temp_dia[$ii])){
    if($temp_dia[$key] == $temp_dia[$ii]){
        array_splice($temp_dia, $ii);
    }
}
}
$temp_dia_length = sizeof($temp_dia);
echo('<div id="semana" class="d-flex align-items-center flex-wrap">');
    for($i = 0 ; $i < $semana_eng_length ; $i++){
        $temp = false;
        for($j = 0 ; $j < $temp_dia_length ; $j++){
        if($temp_dia[$j] == $semana_eng[$i]){
            echo('<div class="container-fluid dia" id="dia' . "$i" . '" style="background-color: #7A398A; color: white" onmouseout="hide()" onmouseenter="show' . "($i)" . '">');
                    echo($semana_br[$semana_eng[$i]]);
                echo('</div>'); 
                
                if($i == 0){
                    print_r("<div id='um' class='absolute' style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 1){
                    echo("<div id='dois' class='absolute'  style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 2){
                    echo("<div id='tres' class='absolute'  style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 3){ 
                    echo("<div id='quatro' class='absolute' style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 4){
                    echo("<div id='cinco' class='absolute' style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else if($i == 5){
                    echo("<div id='seix' class='absolute' style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                    echo("</div>");
                }else{
                    echo("<div id='sete' class='absolute' style='width: 300px; height: 40px; display: none ;' onmouseout='hide()' onhover='show()'>");
                    foreach($data_feriados[0] as $key => $value){
                        if($value == $semana[$i]){
                            print_r($datanome_feriados[$key]);
                            echo("<br>");
                            print_r($tipo_feriados[$key]);
                        }
                    }
                }
                $temp = true;
        }
    }
    if($temp != true){
    echo('<div class="container-fluid dia" id="dia' . "$i" . '" >');
            echo($semana_br[$semana_eng[$i]]);
            echo('</div>');
    }
}
echo('</div>');
?>