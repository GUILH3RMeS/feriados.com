<?php
$api = "https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome";
$request_estados = file_get_contents($api);
$request_estados_json = json_decode($request_estados);
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
            <form action='php/rename.php' method='post' id='form_$estado_url' class='d-flex'>
                <input type='hidden' value='$uf' name='uf'> 
                <input type='hidden' value='$estado_url' name='estado'>
            </form>");
            echo('<a class="a_hover" onClick="');
                echo("document.getElementById('"."form_$estado_url'".').submit();"');
            echo("><div id='$estado_url' class='estado'>$estado</div></a>");
    echo("</div>");
}
echo("</div>");
?>