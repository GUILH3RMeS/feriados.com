<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- title -->
    <title><?php
        $ano = $_COOKIE['ano'];
        $title = $_COOKIE['cidade'];
        $title = str_replace('-', ' ', $title);
        echo($title . " Feriados em $ano!");
    ?></title>

    <!-- description -->
    <meta name="description" content="Saiba todos os feriados e pontos facultativos da cidade de <?php $_COOKIE['cidade'] ?> - <?php $_COOKIE['estado'] ?>. Fique por dentro dos melhores dias para viagem, passeios e folgas.">

    <!-- canonical link -->
    <link rel="canonical" href="<?php echo($_SERVER['REQUEST_URI']); ?>"/>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-unic.css">
    <style>
        div.mes{
            border-bottom: 1px solid black;
            max-width:80%;
            margin:auto;
        }
        .year_container{
            width:25rem;
            background-color: #f0f0f0;
            font-size: 2rem;
            padding: 5px 25px;
            margin: 1.5rem;
            color: #5E0D72;
            border-radius: 8px;
            border:none;
        }
    </style>
</head>
<body>  
<?php
$next_Y = $ano+1;
$prev_Y = $ano-1;
$uf = $_COOKIE['uf'];
$estado = $_COOKIE['estado'];
$cidade = $_COOKIE['cidade'];
$uf = strtolower($uf);
$meses = [" ","janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];
//requisicoes de do site ou banco de dado
$select_api = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$_COOKIE['uf']}/municipios";
$api = "https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome";
$request_estados = file_get_contents($api);
$request_estados_json = json_decode($request_estados);
$request_select = file_get_contents($select_api);
$request_select_json = json_decode($request_select);
$calendario = "https://www.transportal.com.br/feriados/$uf/$cidade/$ano";
$request_municipio = file_get_contents($calendario);
$request_description = file_get_contents("js/descriptions.json");
$description_decode = json_decode($request_description);
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

$c = str_replace('-',' ',$cidade);
  print_r("<h2 class='text-center'>Feriados em ". $c ."</h2>");
  echo('<div id="route" style="font-size: 1.6rem ; margin-left: 2rem">'); 
        $url_nav= $_GET;
        if($_GET && $url_nav['url'] != "home"){
            $URL_ATUAL = str_replace('/', ' > ', $url_nav);
            $u = explode('>', $URL_ATUAL['url']);
            echo("<b>");
            print_R("<a href='home' style='color:#5e0d72'>feriados.com</a>");
            foreach($u as $key => $value){
                if($key > 0){
                $value = trim($value);
                echo(" > ");
                echo("<a style='color:#5e0d72' href='");
                echo("$value'>");
                echo($value);
                echo("</a>");
                }else{
                    $value = trim($value);
                echo(" > ");
                echo("<a style='color:#5e0d72' href='../$u[0]'>");
                echo($value);
                echo("</a>");
                }
            };
            echo("</b>");
        }else{
            echo("<b>");
            echo("<a href='home'>home</a>");
            echo("</b>");
        }
        echo('<br>');
    echo('</div>');
echo("<div id='input_pesquisa' class='text-center' style='margin: auto'>");
    echo('<label for="cidades" style="font-size: 1.8rem">Pesquisar outra cidade</label><br>');
    echo('<select id="cidades" name="cidades" style="margin: auto; width: 25rem">');
    foreach($request_select_json as $key => $value){
      if(property_exists($value, "nome")){
          $city = $value->nome;
          $city_url = sanitizeString($city);
          $city_url = preg_replace('/[^a-z0-9]/i', '-', $city_url);
          $city_url = preg_replace('/_+/', '-', $city_url); // ideia do Bacco :)
          $city_url = strtolower($city_url);
          echo("<option value='$city_url'>$city_url</option>");
      }  
    }
print_r('</select><br>');
print_r('<button onclick="href()" id="search">pesquisar</button>');
print_r("</div>");
print_r("<div id='years' class='flex'>");
echo("<form action='../php/rename.php");
print_r("' method='post'>");
print_r("<input type='hidden' name='uf' value='"."$uf"."'>
        <input type='hidden' value='$cidade' name='cidade'>
        <input type='hidden' name='ano' value='$prev_Y'>");
print_r("<button class='year_container'>Feriados em ". $prev_Y ."</button>");
print_r("</form>");
echo("<form action='../php/rename.php");
print_r("' method='post' style='text-align:end;'>");
print_r("<input type='hidden' name='uf' value='"."$uf"."'>
        <input type='hidden' value='$cidade' name='cidade'>
        <input type='hidden' name='ano' value='$next_Y'>");
print_r("<button class='year_container'>Feriados em ". $next_Y ."</button>");
print_r("</form>");
print_r("</div>");
foreach($data_feriados[0] as $key => $value){
    if($key < 13 && $key > 0){
    echo("<div class='mes text-center' id='mes_$key'><h1 class='h1 font-weight-bold'>$meses[$key]</h1>");
    }
    foreach($mes as $k => $value){
        if($mes[$k] == $key){
            echo("<div id='data_nome_tipo' class='text-left text-justify' style='font-size: 2.6rem'>");
            print_r($data_feriados[0][$k]);
            echo(" - ");
            print_r($nome_feriados[$k]);
            echo(" | ");
            print_r($tipo_feriados[$k]);
            echo("</div>");
            echo("<p id='descricao' class='text-left text-justify' style='font-size: 1.8rem;'>");
            if($tipo_feriados[$k] == 'Feriado Nacional'){
                foreach($description_decode->Feriado_Nacional as $kk => $value){
                    if($nome_feriados[$k] == $value->feriado){
                        print_r($value->descricao);
                    }
                }
            }
            if($tipo_feriados[$k] == 'Feriado Estadual'){
                foreach($description_decode->Feriado_Estadual[0]->$uf as $kk => $value){
                    if($nome_feriados[$k] == $value->feriado){
                        print_r($value->descricao);
                    }
                }
            }
            if($tipo_feriados[$k] == 'Facultativo'){
                foreach($description_decode->Facultativo as $kk => $value){
                    if($nome_feriados[$k] == $value->feriado){
                        print_r($value->descricao);
                    }
                }
            }
            if($tipo_feriados[$k] == 'Dia Convencional'){
                foreach($description_decode->Dia_Convencional as $kk => $value){
                    if($nome_feriados[$k] == $value->feriado){
                        print_r($value->descricao);
                    }
                }
            }
            echo("</p>");
            echo('<br>');


        }
    }
    echo("</div>");
}
echo("<section class='text-center'>");
echo("<h2>Feriados em outras cidades do estado $estado</h2>");
echo('<div id="cidades" class="d-flex text-center" style="width: 75% ; margin:auto">');
foreach($request_select_json as $key => $value){
    if(property_exists($value, "nome")){
        $cidade = $value->nome;
        $cidade_url = sanitizeString($cidade);
        $cidade_url = preg_replace('/[^a-z0-9]/i', '-', $cidade_url);
        $cidade_url = preg_replace('/_+/', '-', $cidade_url); // ideia do Bacco :)
        $cidade_url = strtolower($cidade_url);
        
    }

    echo("
        <div class='_table'> 
            <form action='../php/rename.php' method='post' id='form_$cidade_url'>
                <input type='hidden' name='uf' value='"."{$_COOKIE['uf']}"."'>
                <input type='hidden' value='$cidade_url' name='cidade'>
                <input type='hidden' name='ano' value='$ano'>
            </form>");
            echo('<a class="a_hover" onClick="');
            echo("document.getElementById('"."form_$cidade_url'".').submit();"');
            echo("><div id='$cidade_url' class='cidade'>$cidade</div></a></div>");
}
echo("</div>");
echo("</section>");
echo("<section class='text-center'>");
echo("<h2>Feriados em outros estados</h2>");
echo('<div id="estados" class="d-flex">');
foreach($request_estados_json as $key => $value){
    if(property_exists($value, "nome")){
        $estado = $value->nome;
        $estado_url = sanitizeString($estado);
        $estado_url = preg_replace('/[^a-z0-9]/i', '-', $estado_url);
        $estado_url = preg_replace('/_+/', '-', $estado_url); // ideia do Bacco :)
        $estado_url = strtolower($estado_url);
    } 
    if(property_exists($value, "sigla")){
        $uf = $value->sigla;
        $uf = strtolower($uf);
    }
    echo("
        <div class='_table'>
            <form action='../php/rename.php' method='post' id='form_$estado_url' class='d-flex'>
                <input type='hidden' value='$uf' name='uf'> 
                <input type='hidden' value='$estado_url' name='estado'>
            </form>");
            echo('<a class="a_hover" style="color:#5E0D72" onClick="');
                echo("document.getElementById('"."form_$estado_url'".').submit();"');
            echo("><div id='$estado_url' class='estado'>$estado</div></a>");
    echo("</div>");
}
echo("</div>");
echo("</section>");
?>
<script>
    function href(){
        link = document.getElementById('select2-cidades-container').title
        document.getElementById(`form_${link}`).submit();
    }
</script>
</body>
</html>