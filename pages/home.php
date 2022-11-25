   <!DOCTYPE html>
   <html lang="pt-br">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   </head>
   <body>
   <section id="feriados_da_semana" style="width: 80%;" class="container">
        <h2 class="text-center" style="margin-bottom: 0.2rem ; margin-top: 3.5rem;">Feriados da semana</h2>
        <?php include "php/dias_da_semana.php";?>
    </section>
        <h2 class="text-center" style="margin-bottom: 0.2rem ; margin-top: 3.5rem;">Seleciona um estado para visualizar suas cidades</h2>
    <section id="estados_do_brasil" style="width: 80%;" class="container">
        <?php include "php/estados.php"; 
        ?>
    </section>
    <script>
feriados1 = document.getElementById('um');
feriados2 = document.getElementById('dois');
feriados3 = document.getElementById('tres');
feriados4 = document.getElementById('quatro');
feriados5 = document.getElementById('cinco');
feriados6 = document.getElementById('seix');
feriados7 = document.getElementById('sete');
dia0 = document.getElementById('dia0');
dia1 = document.getElementById('dia1');
dia2 = document.getElementById('dia2');
dia3 = document.getElementById('dia3');
dia4 = document.getElementById('dia4');
ia5 = document.getElementById('dia5');
dia6 = document.getElementById('dia6');
function show(){
        feriados4.style.display = 'block'
        feriados7.style.display = 'block'
}
</script>
   </body>
   </html>