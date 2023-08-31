<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 31MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO CARTÃO  */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $valor      = $_GET['valor'];
     $idCliente  = $_GET['id_cliente'];
     $usuario    = strtoupper($_GET['usuario']);
     $km         = $_GET['km'];
     $desconto   = $_GET['desconto'];
     $mecanico   = strtoupper($_GET['mecanico']);
     $garantia   = strtoupper($_GET['garantia']);
     $comentario = strtoupper($_GET['comentario']);
     $parcelas   = $_GET['parcelas'];
     $desconto   = str_replace(',','.',$desconto);
     $valor      = str_replace(',', '.',$valor);
// PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     $valor = ($valor - $desconto); // VALOR COM O DESCONTO //

     // ## DESCRIÇÃO DO PAGAMENTO COM CARTÃO CRÉDITO E QUANTIDADE DE VEZES  ## //
     $descricao   = 'PAGAMENTO CREDITO '.$parcelas.'x..: '.$pedido;
     $description = 'CREDITO '.$pedido;
      
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


    // ALTERAR A FORMA DE PAGAMENTO //
        $sql = mysql_query("UPDATE carteira SET pagCliente_fk = '$idCliente', pagPedido_fk = '$pedido', pagFormaPagto = 2, pagStatus = 'FECHADO', pagBandeira = '$descricao', pagParcela = '$parcela', pagValor = '$valor', pagDataPag = '$data', pagData = '$data', pagHora = '$hora', pagResponsavel = '$usuario' WHERE pagPedido_fk = '$pedido'");
       // SALVANDO NA TABELA DE PEDIDOS A ALTERAÇÃO //
        mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto', pedHora = '$hora', pedPedido_fk = 2, pedKm = '$km', pedGarantia = '$garantia', pedComentario = '$comentario', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'");  // FECHA O PEDIDO NA TABELA DE PEDIDOS //
       // SALVANDO NA TABELA DE CAIXA A ALTERAÇÃO //
        mysql_query("UPDATE caixa SET caxDescricao = '$description', caxVlrEntrada = '$valor', caxData = '$data',caxHora = '$hora' WHERE caxCodigo = '$caxPedido'");
          // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
         mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");

// SE NÃO CONSEGUIR ALTERAR A FORMA DE PAGAMENTO, ENTÃO RETORNA 0 PARA A MENSAGEM DE EXCEÇÃO //
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