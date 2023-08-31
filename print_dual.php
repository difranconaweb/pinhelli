<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 28MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 28MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 28MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 30MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 03JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 
<!-- ####   ARQUIVO PARA IMPRESSÃO EM IMPRESSORA FISCAL  ###  */
session_start();  //  INICIALIZA A SESSÃO //
ob_start();
require 'Utilidades/conexao.php';  // CONEXAO COM O BANCO DE DADOS //
require 'tcpdf/tcpdf.php';


 $usuario = $_SESSION['usuario'];  //  ####   VARIÁVEL DE SESSÃO COM NOME DO RESPONSAVEL DO ORÇAMENTO  #####  //
 $pedido  = $_REQUEST['pedido']; // ### RECEBE O NÚMERO DO PEDIDO ### //




// $custom_layout = array(210, 297);
$custom_layout = array(90, 510); //$custom_layout = array(90, 510);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
$pdf->SetMargins(4, 4, 4);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 10, '', true);

$pdf->AddPage();
// ###  CARREGANDO OS DADOS DO CLIENTE NA TELA ### //
/*SELECT cliNome, cliEndereco, cliNumero, cliCelular, cliMoto, cliPlaca, pedIteResponsavel, pedIteKm, pedIteData FROM clientes INNER JOIN pedidos_itens ON pedido_itens.pedIteCliente_fk = clientes.cliCodigo WHERE pedido_itens.pedItePedido_fk = '$pedido'*/
           $log = mysql_query("SELECT cliNome, cliEndereco, cliNumero, cliCelular, cliVeiculo, cliPlaca, pedResponsavel, pedKm, pedData,pedDesconto,pedMecanico FROM clientes INNER JOIN pedidos ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedidos.pedCodigo = '$pedido'");
           while($_obj = mysql_fetch_array($log))
            {
                 $nome        = $_obj['cliNome'];  // NOME DO CLIENTE PARA CARREGAR NO FORMULARIO DE ENVIO DE EMAIL //
                 $celular     = $_obj['cliCelular'];  // NUMERO DO CELULAR DO CLIENTE //
                 $veiculo     = $_obj['cliVeiculo'];  // MODELO DO VEICULO //
                 $placa       = $_obj['cliPlaca'];  // PLACA DA MOTO DO CLIENTE //
                 $km          = $_obj['pedKm'];  // KILOMETRAGEM DA MOTO //
                 $data        = $_obj['pedData'];  // DATA DO PEDIDO //
                 $responsavel = $_obj['pedResponsavel'];  // NOME DO RESPONSÁVEL DO PEDIDO //
                 $desconto    = $_obj['pedDesconto']; // CARREGA P VALOR DO DESCONTO //
                 $mecanico    = $_obj['pedMecanico']; // NOME DO MECANICO //
            }
            
            // ## CARREGANDO O CONTEUDO DA TABELA  ## //
            $content = mysql_query("SELECT pedIteIdProduto_fk,pedIteQuantidade,pedIteDescricao AS descricao,pedIteTotal FROM pedido_itens WHERE pedItePedido_fk = '$pedido'");



$html='';

//$html.= '<h1>EXEMPLO</h1>';

$html.='
<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:10px;padding:10px 5px;overflow:hidden;word-break:normal;}
  .tg th{font-family:Arial, sans-serif;font-size:8px;font-weight:normal;padding:10px 5px;overflow:hidden;word-break:normal;font-weight: bold;}
  .tg .tg-yw4l{vertical-align:top}

  .hr1{
    overflow: visible; /* For IE */
    height: 2px;
    border-style: solid;
    border-color: black;
    border-width: 1px 0 0 0;
    border-radius: 20px;
  }
</style>';

$html.='<hr class="hr1">';
$html.='<img src="img/logo_end_cliente.jpg" alt="Graus Motos">';
$html.='<hr class="hr1">';
$html.='<table class="tg">
    <tr>
      <th class="tg-yw4l">Pedido.:'. $pedido.'</th>
      <th class="tg-yw4l">Data.:'.$data.'</th>
    </tr>
    <tr>
      <th class="tg-yw4l">Cliente.:'.$nome.'</th>
    </tr>
    <tr>
      <th class="tg-yw4l">Celular.:'.$celular.'</th>
      <th class="tg-yw4l">Tecnico.:'.$mecanico.'</th>
    </tr>
    <tr>
      <th class="tg-yw4l">Veiculo.:'.$veiculo.'</th>
      <th class="tg-yw4l">Placa.:'.$placa.'</th>
    </tr>
    <tr>
      <th class="tg-yw4l">Responsável.:'.$responsavel.'</th>
      <th class="tg-yw4l">Km.:'.$km.'</th>
    </tr>
</table>';
$html.='<table border="1" class="tg">
   <tr>
        <th style="width:25px">ITEM</th>
        <th style="width:35px">QUANT</th>
        <th style="width:120px">DESCRICAO</th>
        <th style="width:50px">PREÇO</th>
    </tr>';

while($cont = mysql_fetch_array($content)){
 $html.='<tr>';
 $html.='<th style="width:25px">'.$cont['pedIteIdProduto_fk'].'</th>';
 $html.='<th style="width:35px">'.$cont['pedIteQuantidade'].'</th>';
 $html.='<th style="width:120px">'.utf8_encode($cont['descricao']).'</th>';
 $html.='<th style="width:50px">'.$cont['pedIteTotal'].'</th>';
 $html.='</tr>';
} 

$html.='</table>';
// ## VALOR FINAL DO PEDIDO ## //
$sql = mysql_query("SELECT pedValor,pedDesconto,pedComentario FROM pedidos WHERE pedCodigo = '$pedido'");
while($_sql = mysql_fetch_array($sql))
{
   $total      = $_sql['pedValor'];
   $desconto   = $_sql['pedDesconto'];
   $comentario = $_sql['pedComentario'];
}
$html.='<br>';
$html.='<table border="1" class="tg">
   <tr>
        <th style="width:180px">VALOR DESCONTO</th>
        <th style="width:50px">R$'.$desconto.'</th>
   </tr>
   <tr>
        <th style="width:180px">VALOR TOTAL PEDIDO</th>
        <th style="width:50px">R$'.$total.'</th>
   </tr>
</table>';

$html.='<br>';
$html.='<h6 style="text-align:left"><strong>
  OBS.: CLIENTE CONCORDA COM O SERVIÇO/PEÇAS DISCRIMINADO ACIMA E ASSINA> <br><br></h6>';
$html.='<h6 style="text-align:left"><strong>
  ASSINATURA.: ___________________________________ <br></h6>';
$html.='<h6 style="text-align:left"><strong>
  COMENTÁRIOS.: '.$comentario.'</h6>';
ob_end_clean();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output(dirname(__FILE__).'/print_dual.pdf', 'I');


// ### FIM DE ROTINA  ###  //               
?>                 