<?php


$valor = '2.011,21';
$valor = str_replace('.','',$valor);
$valor = str_replace(',','.',$valor);
$len   = strlen($valor);

//$len = strlen($valor);
print $valor."</br>";
//print $len;

$mes = date('m');

switch($mes)
     {
        case $mes == 1:
        $mes = 'JAN';
        break;

        case $mes == 2:
        $mes = 'FEV';
        break;
        
        case $mes == 3:
        $mes = 'MAR';
        break;

        case $mes == 4:
        $mes = 'ABR';
        break;

        case $mes == 5:
        $mes = 'MAI';
        break;

        case $mes == 6:
        $mes = 'JUN';
        break;

        case $mes == 7:
        $mes = 'JUL';
        break;

        case $mes == 8:
        $mes = 'AGO';
        break;

        case $mes == 9:
        $mes = 'SET';
        break;

        case $mes == 10:
        $mes = 'OUT';
        break;

        case $mes == 11:
        $mes = 'NOV';
        break;

        case $mes == 12:
        $mes = 'DEZ';
        break;

        default:
        $mes > 12;$mes == 'JAN';
     }


print $mes;

/*$vl = 1280.25;
$vl      = str_replace(',', '.',$vl);
$vl1 = 30.00;

//print $vl - $vl1;
/*<label for='kilometragem'><strong>DIGITE A KILOMETRAGEM</strong></label><div class='row form-group'><div class='col-md-6 mb-3 mb-md-0'><div class='col-md-6'><input type='text' name='km' id='km' onblur='func_km()' class='form-control'></div><div class='col-md-6 mb-6 mb-md-0'><label for='off'><strong>DIGITE DESCONTO PEDIDO</strong></label><div class='col-md-6'><input type='text' name='desconto' id='desconto' onkeypress=return(MascaraMoeda(this,'.',',',event)) onblur='func_desconto()'></div></div></div></br><div class='row form-group'><div class='col-md-6 mb-6 mb-md-0'><label for='prazo'><strong>DIGITAR PRAZO GARANTIA</strong></label><div class='col-md-6'><input type='text' name='garantia' id='garantia' onblur='func_garantia()'></div></div><div class='col-md-6 mb-3 mb-md-0'><label for='pagamento'><strong>FORMA DE PAGAMENTO</strong></label><div class='col-md-6'><select name='pagamento' id='pagamento' onchange='forma_pagto()'><option value='0'>Selecione</option><option value='1'>Boleto</option><option value='2'>Cartao Crédito</option><option value='3'>A Vista</option><option value='4'>2 Parcelas</option><option value='5'>3 Parcelas</option></select></div></div></div></br><div class='row form-group'><div class='col-md-6 mb-3 mb-md-0'><label for='comentary'><strong>COMENTÁRIO</strong></label><div class='col-md-10'><textarea cols='50' rows='02' name='comentario' id='comentario' onblur='func_comentario()' class='fundo'></textarea></div></div></div></br><div class='row form-group'>   </div></div>    <ul><input type='button' class='btn btn-primary btn-md btn-green text-white' value='GRAVAR' onclick='yes_km()'><input type='button' class='btn btn-primary btn-md btn-blackRed text-white' value='FECHAR' onclick='no_km()'><span id='ex_gravar' class='ex_gravar'></span></ul>




require 'Utilidades/conexao.php'; // CHAMA O ARQUIVO DE CONEXÃO // */
/*$codigo = 1253;
   DEFINE('CODIGO',$codigo); print CODIGO;*/

?>


<html>
<head>
    <script type="text/javascript">
      /*  ###   MASCARA PARA VALORES EM DINHEIRO   ###  */
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
  }



      function teste()
      {
          var valor = document.getElementById("valor").value;

         // if(desconto<1000){desconto = desconto.replace(",",".");}else{desconto = desconto.replace(".","");desconto = desconto.replace(",",".");}//

          //if(valor<1000){valor = valor.replace(",",".");}else{valor = valor.replace(".","");valor = valor.replace(",",".");}
          //alert(valor);
      }
    </script>
</head>


<body>
      <!--input type="text" name="valor" id="valor" size="50" placeholder="ESCREVA AQUI"  onKeyPress="return(MascaraMoeda(this,'.',',',event))"-->
      <!--input type="button" name="exec" id="exec" value="EXEC" onclick="teste()"-->

</body>
</html>
