<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 31MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO TRES PARCELAS  */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $valor      = $_GET['valor'];
     $idCliente  = $_GET['idCliente'];
     $usuario    = strtoupper($_GET['usuario']);
     $km         = $_GET['km'];
     $desconto   = $_GET['desconto'];
     $mecanico   = $_GET['mecanico'];
     $garantia   = strtoupper($_GET['garantia']);
     $priData    = $_GET['priData'];
     $segData    = $_GET['segData'];
     
    
     
     // PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     $valor = ($valor - $desconto); // VALOR COM O DESCONTO //


// COLETANDO AS DATA E HORA NO SERVIDOR //
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');
     


    //  VERIFICA ANTES DE SALVAR SE HÁ CLIENTE SALVO NA TABELA  //
    $cli = mysql_query("SELECT pagPedido_fk FROM pagamentos WHERE pagPedido_fk = '$pedido'");
    while($ob = mysql_fetch_array($cli))
    {
         $pagPedido = $ob['pagPedido_fk']; 
    }


// ## OPÇÃO PARA PAGAMENTO..: 0 - SELECIONE / 1 - BOLETO / 2 - CARTÃO CRÉDITO / 3 - A VISTA / 4 - 2 PARCELAS / 5 - 3 PARCELAS ## //
     if(empty($pagPedido)) //  CASO NÃO HAJA AGENDAMENTO, VOLTA COM MENSAGEM DE EXCESSAO //
     {
          $sql = mysql_query("INSERT INTO pagamentos (pagCliente_fk, pagStatus, pagPedido_fk, pagFormaPagto, pagBandeira, pagParcela, pagValor, pagDataPag, pagDataPag_2, pagDataPag_3, pagData, pagHora, pagResponsavel) VALUES ('$idCliente', 'ABERTO', '$pedido', 5, 'BOLETO', 3, '$valor', '$priData', '$segData', '$terData', '$data', '$hora', '$usuario')");

          mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto', pedData = '$data', pedKm = '$km', pedGarantia = '$garantia', pedHora = '$hora', pedPedido_fk = 2 , pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'");  // FECHA O PEDIDO NA TABELA DE PEDIDOS //

           // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
         mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");

// CASO NÃO CONSIGO INSERIR A FORMA DE PAGAMENTO A VISTA, RETORNA ZERO PARA MENSAGEM DE EXCEÇÃO //
          if(empty($sql))
            {
               print 0;
            }

            else
            {
               print 1;
            }
     }

     else
     {// ALTERAR A FORMA DE PAGAMENTO //
         
 // CASO NÃO CONSIGO ALTERAR A FORMA DE PAGAMENTO A VISTA, RETORNA ZERO PARA MENSAGEM DE EXCEÇÃO //
         $sql = mysql_query("UPDATE pagamentos SET pagCliente_fk = '$idCliente', pagStatus = 'ABERTO', pagFormaPagto = 5, pagParcela = 3, pagValor = '$valor', pagDataPag = '$priData', pagDataPag_2 = '$segData', pagDataPag_3 = '$terData', pagData = '$data', pagHora = '$hora', pagResponsavel = '$usuario' WHERE pagPedido_fk = '$pedido'");

         mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto', pedHora = '$hora', pedPedido_fk = 2, pedData = '$data', pedKm = '$km', pedGarantia = '$garantia', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'");  // FECHA O PEDIDO NA TABELA DE PEDIDOS //

          // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
         mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");


            if(empty($sql))
            {
               print 0;
            }

            else
            {
               print 1;
            }
     }
?>