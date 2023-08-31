<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 29MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 30MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 
<!-- ####   ARQUIVO PARA IMPRESSÃO EM PDF  ###  */


session_start();  //  INICIALIZA A SESSÃO //
require 'Utilidades/conexao.php';  // CONEXAO COM O BANCO DE DADOS //
require_once("pdf/fpdf.php");
//require('mc_table.php');

 $usuario = $_SESSION['usuario'];  //  ####   VARIÁVEL DE SESSÃO COM NOME DO RESPONSAVEL DO ORÇAMENTO  #####  //
 $pedido  = $_REQUEST['pedido']; // ### RECEBE O NÚMERO DO PEDIDO ### //


 
$pdf= new fPDF("portrait","pt","A4");

$pdf->setLineWidth(1);// Definindo a margem das cedulas

$pdf->AddPage();
// ###  CARREGANDO OS DADOS DO CLIENTE NA TELA ### //
           $log = mysql_query("SELECT cliNome, cliEndereco, cliNumero, cliCelular, cliVeiculo, cliPlaca, pedResponsavel, pedData, pedKm, pedDesconto, pedMecanico FROM clientes INNER JOIN pedidos ON pedidos.pedCliente_fk = clientes.cliCodigo WHERE pedidos.pedCodigo = '$pedido'");
           while($_obj = mysql_fetch_array($log))
            {
                 $nome        = $_obj['cliNome'];  // NOME DO CLIENTE PARA CARREGAR NO FORMULARIO DE ENVIO DE EMAIL //
                 $celular     = $_obj['cliCelular'];  // NUMERO DO CELULAR DO CLIENTE //
                 $veiculo     = $_obj['cliVeiculo'];  // MODELO DO VEICULO //
                 $placa       = $_obj['cliPlaca'];  // PLACA DA MOTO DO CLIENTE //
                 $km          = $_obj['pedKm'];  // KILOMETRAGEM DO VEICULO //
                 $data        = $_obj['pedData'];  // DATA DO PEDIDO //
                 $responsavel = $_obj['pedResponsavel'];  // NOME DO RESPONSÁVEL DO PEDIDO //
                 $desconto    = $_obj['pedDesconto'];  // DESCONTO DO PEDIDO //
                 $mecanico    = $_obj['pedMecanico'];  // MECANICO DO PEDIDO //
            }




 
$pdf->Cell(10,10,'',0,1,"L");//  ESTA LINHA FOI CRIADA PARA DAR ESPAÇO ENTRE A IMAGEM E O CABEÇÁRIO //


$pdf->Image('img/logo_end_cliente.jpg');
$pdf->Cell(00,20,"Pedido.: ",0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->SetFontSize(12);
$pdf->Cell(00,10,'',0,1,"L");//  ESTA LINHA FOI CRIADA PARA DAR ESPAÇO ENTRE O CABEÇÁRIO E A GRID //
$pdf->Cell(00,20,"Pedido.: ".$pedido,0,0,'L');
$pdf->Cell(00,20,"Data : ".$data,0,1,'R');
$pdf->Cell(00,20,utf8_decode("Cliente : ".$nome),0,1,'L');
$pdf->Cell(00,20,"Celular : ".$celular,0,1,'L');
$pdf->Cell(00,20,"Tecnico : ".$mecanico,0,1,'R');
$pdf->Cell(00,20,"Veiculo : ".$veiculo,0,0,'L');
$pdf->Cell(00,20,"Placa : ".$placa,0,1,'R');
$pdf->Cell(00,20,utf8_decode("Responsável : ".$responsavel),0,0,'L');
$pdf->Cell(00,20,"Km : ".$km,0,0,'R');
$pdf->Cell(0,1,"","B",1,'C');

$pdf->Ln(8);
$pdf->Ln();
 
$pdf->Cell(60,20,'',0,1,"L");//  ESTA LINHA FOI CRIADA PARA DAR ESPAÇO ENTRE A IMAGEM E O CABEÇÁRIO //
// ################################################################################################ //

// CABECALHO DA TABELA //
$pdf->SetFont('arial','B',8);
$pdf->SetFontSize(8);
$pdf->Cell(60,30,"ITEM",1,0,"C");
$pdf->Cell(35,30,"QUANT",1,0,"C");
$pdf->Cell(385,30,utf8_decode("DESCRIÇÃO"),1,0,"C");
$pdf->Cell(60,30,utf8_decode("PREÇO"),1,0,"C");


 $pdf->ln();
$pdf->SetFont('Arial','B',06);
//Table with 32 rows and 4 columns
//$pdf->SetWidths(array(50,50));
srand(microtime()*1000000);

$content = mysql_query("SELECT * FROM pedido_itens WHERE pedItePedido_fk = '$pedido'");

while($cont = mysql_fetch_array($content))
{  
     $pdf->SetFont('arial','B',8);
     $pdf->SetFontSize(7);

     $pdf->SetFillColor(255);

     $pdf->Cell(60, 20, $cont['pedIteIdProduto_fk'], 1, 0, 'L');
     $pdf->Cell(35, 20, $cont['pedIteQuantidade'], 1, 0, 'C');
     $pdf->SetFontSize(6);
     $pdf->Cell(385, 20, $cont['pedIteDescricao'], 1, 0, 'L');
     $pdf->SetFontSize(8);
     $pdf->Cell(60, 20, "R$ ".$cont['pedIteTotal'], 1, 0, 'L');
   
     
     $pdf->ln();


     // $pdf->Row(array($obk['patrimonio'],$obk['item'],$obk['inspTipoExtintor'],$obk['inspCargaNominal'],$obk['recarga'],$obk['reteste'],$obk['local_galpao'],$obk['inspItemNaoConformidade'],$obk['inspDataEnd']));
}





     // $pdf->Row(array($obk['patrimonio'],$obk['item'],$obk['inspTipoExtintor'],$obk['inspCargaNominal'],$obk['recarga'],$obk['reteste'],$obk['local_galpao'],$obk['inspItemNaoConformidade'],$obk['inspDataEnd']));


// ## VALOR FINAL DO ORÇAMENTO ## //
$sql = mysql_query("SELECT pedValor,pedComentario FROM pedidos WHERE pedCodigo = '$pedido'");
while($_sql = mysql_fetch_array($sql))
{
   $total      = $_sql['pedValor'];
   $comentario = $_sql['pedComentario'];
}
$pdf->SetFont('arial','B',8);
$pdf->SetFontSize(8);
$pdf->Cell(480,20,'VALOR DESCONTO:',1,0,"L");$pdf->Cell(60,20,$desconto,1,0,"L");
//$pdf->Cell(10,20,'',0,0,"R");
$pdf->ln();
$pdf->SetFont('arial','B',8);
$pdf->SetFontSize(8);
$pdf->Cell(480,20,utf8_decode('VALOR TOTAL PEDIDO:'),1,0,"L");$pdf->Cell(60,20,"R$ ".$total,1,0,"L");
//$pdf->Cell(10,20,'',0,0,"R");
$pdf->ln();







$pdf->ln();

 

/*for($i = 1; $i<=2; $i++)
{  
     
     $pdf->SetFont('arial','B',6);
     $pdf->SetFontSize(8);

     $pdf->SetFillColor(255);

     $pdf->Cell(100, 20, 'Line'. $i, 1, 0, 'C');
     $pdf->Cell(200, 20, 'Line'. $i, 1, 0, 'C');
     
     $pdf->ln();
}*/


$pdf->ln();



$pdf->ln();

/*for($i = 1; $i<=2; $i++)
{  
     $pdf->SetFont('arial','B',8);
     $pdf->SetFontSize(8);

     $pdf->SetFillColor(255);

     $pdf->Cell(150, 20, 'Line'. $i, 1, 0, 'C');
     $pdf->Cell(50, 20, 'Line'. $i, 1, 0, 'C');


CREATE TABLE naoConformidadesSoma (sumCodigo INT AUTO INCREMENT NOT NULL,sumInspecao INT NOT NULL,sumConformidade VARCHAR(30) NOT NULL,sumHora CHAR(8) NOT NULL,sumData CHAR(10),sumQtdNaoConformidades INT NOT NULL,sumTotalEquipamentos INT NOT NULL)


     
     $pdf->ln();
}*/

$pdf->SetFont('arial','B',8);
$pdf->SetFontSize(8);

$pdf->ln();$pdf->ln();$pdf->ln();
$pdf->Cell(100, 20, ' ', 'B', 0, 'C');
$pdf->Cell(100, 20, ' ', 'B', 0, 'C');
$pdf->Cell(100, 20, ' ', 'B', 0, 'C');
$pdf->Cell(100, 20, ' ', 'B', 0, 'C');

$pdf->Cell(100, 20, ' ', 0, 0, 'C');
$pdf->ln();



$pdf->ln();
$objCo = mysql_query("SELECT pedGarantia, pedComentario FROM pedidos WHERE pedCodigo = '$pedido'"); 
                        while($objC = mysql_fetch_array($objCo))
                         {
                               $validade    = $objC['pedGarantia'];
                               $comentarios = $objC['pedComentario'];
                         }
$pdf->Cell(70, 20, utf8_decode('OBS.: CLIENTE CONCORDA COM O SERVIÇO/PEÇAS DISCRIMINADO ACIMA E ASSINA'), 0, 1, 'L');
$pdf->Cell(70, 20, 'COM GARANTIA DE '.$validade, 0, 1, 'L');
$pdf->Cell(70, 20, 'ASSINATURA.:__________________________________________________________________.', 0, 1, 'L');
$pdf->Cell(70, 20, utf8_decode('COMENTÁRIOS :').$comentarios, 0, 1, 'L');
$pdf->Cell(50, 20, ' ', 0, 0, 'C');


$pdf->Output("printerr.pdf","I");


/* ### FIM DE ROTINA  ###  */               


/* SELECT sum(case when inspIntempere=1 then 0 else 1 end)+sum(case when inspLacre=0 then 1 else 0 end)+sum(case when inspValidade=0 then 1 else 0 end)+sum(case when inspQuadro=0 then 1 else 0 end)+sum(case when inspAspecto=0 then 1 else 0 end)+sum(case when inspTransporte=0 then 1 else 0 end)+sum(case when inspCondicoes=0 then 1 else 0 end)+sum(case when inspCorpo=0 then 1 else 0 end)+sum(case when inspPonteiro=0 then 1 else 0 end)+sum(case when inspExistencia=0 then 1 else 0 end)+sum(case when insporificio=0 then 1 else 0 end)+sum(case when inspCO2=0 then 1 else 0 end)+sum(case when inspHidrante=0 then 1 else 0 end)+sum(case when inspCompleto=0 then 1 else 0 end)+sum(case when inspEsguicho=0 then 1 else 0 end)+sum(case when inspMangueira=0 then 1 else 0 end)+sum(case when inspChave=0 then 1 else 0 end)+sum(case when inspHidObstruido=0 then 1 else 0 end)+sum(case when inspDemarSolo=0 then 1 else 0 end)+sum(case when inspPlaca=0 then 1 else 0 end)+sum(case when inspAdaptador=0 then 1 else 0 end)+sum(case when inspVidro=0 then 1 else 0 end) FROM inspecao_item WHERE inspIdInspecao_fk = 937 */
 //    SELECT sum(case when inspIntempere=1 then 1 else 0 end) FROM inspecao_item WHERE inspIdInspecao_fk = 937

//SELECT SUM(inspIntempere.a+inspLacre.b) FROM (SELECT COUNT(inspIntempere) AS a, COUNT(inspLacre) AS b FROM `inspecao_item` WHERE inspIdInspecao_fk = 937 AND inspIntempere = 1 OR inspLacre = 0)
//SELECT COUNT(inspIntempere) AS a, COUNT(inspLacre) AS b FROM `inspecao_item` WHERE inspIdInspecao_fk = 937 AND inspIntempere = 1 AND inspLacre = 0
 /*    $pdf->ln();
}*/
?>                 