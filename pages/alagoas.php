<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->

    <title>
        <?php
        $title = $_COOKIE['estado'];
        $tile = str_replace('-', ' ', $title);
        echo($title . " Feriados em 2022!");
    ?>
    </title>
    <!-- description -->

    <meta name="description" content="Feriados municipais, estaduais e nacionais no estado <?php echo($_COOKIE['estado']); ?> - Brasil 2022. Confira os feriados das cidades no estado de <?php echo($_COOKIE['estado']); ?>">
    <link rel="stylesheet" href="css/bootstrap-estado.css">

    <!-- canonical link -->
    <link rel="canonical" href="<?php echo($_SERVER['REQUEST_URI']); ?>"/>
</head>
<body>
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
                echo("<a style='color:#5e0d72' href='$estado'>");
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
echo('</select><br>');
echo('<button onclick="href()" id="search">pesquisar</button>');
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

    echo("
        <div class='_table'> 
            <form action='php/rename.php' method='post' id='form_$cidade_url'>
                <input type='hidden' name='uf' value='"."{$_COOKIE['uf']}"."'>
                <input type='hidden' value='$cidade_url' name='cidade'>
                <input type='hidden' name='ano' value='$ano'>
            </form>");
            echo('<a class="a_hover" onClick="');
            echo("document.getElementById('"."form_$cidade_url'".').submit();"');
            echo("><div id='$cidade_url' class='cidade'>$cidade</div></a></div>");
}
echo("</div>");

?>
<script>
    function href(){
        link = document.getElementById('select2-cidades-container').title
        document.getElementById(`form_${link}`).submit();
    }
</script>
</body>
</html>