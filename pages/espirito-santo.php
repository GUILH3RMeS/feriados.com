<?php
$api = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$_COOKIE['uf']}/municipios";
$request_municipio = file_get_contents($api);
$request_municipio_json = json_decode($request_municipio);
$ano = date("y");

$estado = $_COOKIE['estado'];
$e = str_replace('-',' ',$estado);
  print_r("<h2 class='text-center'>Estado de ". $e ."</h2>");
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
                echo("<a style='color:#5e0d72' href='javascript:history.back()'>");
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
    echo('<label for="cidades" style="font-size: 1.8rem">Pesquisar a cidade</label><br>');
    echo('<select id="cidades" name="cidades" style="margin: auto; width: 25rem">');
    foreach($request_municipio_json as $key => $value){
      if(property_exists($value, "nome")){
          $cidade = $value->nome;
          $cidade_url = sanitizeString($cidade);
          $cidade_url = preg_replace('/[^a-z0-9]/i', '-', $cidade_url);
          $cidade_url = preg_replace('/_+/', '-', $cidade_url); // ideia do Bacco :)
          $cidade_url = strtolower($cidade_url);
          echo("<option value='$cidade_url'>$cidade_url</option>");
      }  
    }
echo('</select>');
echo("</div>");
echo('<div id="cidades" class="d-flex text-center" style="width: 75% ; margin:auto">');
foreach($request_municipio_json as $key => $value){
    if(property_exists($value, "nome")){
        $cidade = $value->nome;
        $cidade_url = sanitizeString($cidade);
        $cidade_url = preg_replace('/[^a-z0-9]/i', '-', $cidade_url);
        $cidade_url = preg_replace('/_+/', '-', $cidade_url); // ideia do Bacco :)
        $cidade_url = strtolower($cidade_url);
        
    }

    echo("<div id='$cidade_url' class='cidade'><form action='"."php/rename.php"."' method='post'><input type='hidden' name='cidade' value='$cidade_url'><input type='hidden' name='uf' value='"."{$_COOKIE['uf']}"."'><input type='hidden' name='ano' value='"."$ano"."'><button type='submit' class='btn btn-light grande font-weight-bold'>$cidade - {$_COOKIE['uf']}</button></form></div>");
}
echo("</div>");

?>