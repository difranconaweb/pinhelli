<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 15JUL23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO PIX */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $valor      = $_GET['valor'];
     $idCliente  = $_GET['id_cliente'];
     $usuario    = strtoupper($_GET['usuario']);
     $km         = $_GET['km'];
     $desconto   = $_GET['desconto'];
     $mecanico   = strtoupper($_GET['mecanico']);
     $garantia   = strtoupper($_GET['garantia']);
     $desconto   = str_replace(',','.',$desconto);
     $valor      = str_replace(',', '.',$valor);
// PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     $valor = ($valor - $desconto); // VALOR COM O DESCONTO //

      
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


         // ## COLEÇÃO DE QUERIES PARA ALTERAR O PAGAMENTO ## //
         $sql = mysql_query("UPDATE carteira SET pagCliente_fk = '$idCliente', pagPedido_fk = '$pedido', pagStatus = 'FECHADO', pagFormaPagto = 2, pagBandeira = 'DEBITO', pagParcela = 1, pagValor = '$valor', pagDataPag = '$data', pagData = '$data', pagHora = '$hora', pagResponsavel = '$usuario' WHERE pagPedido_fk = '$pedido'");

          mysql_query("UPDATE pedidos SET pedValor = '$valor', pedDesconto = '$desconto', pedHora = '$hora', pedPedido_fk = 2, pedKm = '$km', pedGarantia = '$garantia', pedComentario = '$comentario', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano'WHERE pedCodigo = '$pedido'");  // FECHA O PEDIDO NA TABELA DE PEDIDOS //

          // ATUALIZANDO A TABELA DE PEDIDO DEDICADA DO USUARIO  //
          mysql_query("UPDATE $usuario SET Valor = '$valor', Desconto = '$desconto'");
     
          // ATUALIZANDO A TABELA DE CONTAINER_PEDIDO PARA O USUÁRIO ESPECIFICO //
          mysql_query("UPDATE container_pedido SET conStatus = 3 WHERE conResponsavel = '$usuario'");
          // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O VALOR DO DESCONTO, BEM COMO A KM  //
          mysql_query("UPDATE pedido_itens SET pedIteKm = '$km' WHERE pedItePedido_fk = '$pedido'");

         // ##   VERIFICA SE CONSTA ESTE PEDIDO DA VIARÁVEL NA TABELA DE CAIXA ## //
          $cax = mysql_query("SELECT caxCodigo FROM caixa WHERE caxIdPedido_fk = '$pedido'");
          while($_cax = mysql_fetch_array($cax))
          {
              $caxPedido = $_cax['caxCodigo'];
          }

          if(empty($caxPedido)){// INSERE O PEDIDO COM PAGAMENTO A VISTA NA TABELA DE CAIXA //
          mysql_query("INSERT INTO caixa (caxIdPedido_fk, caxDescricao, caxVlrEntrada, caxVlrSaida, caxData, caxHora, caxResponsavel)  VALUES ('$pedido','PAGAMENTO PIX ..: $pedido','$valor','','$data','$hora','$usuario')");}else{mysql_query("UPDATE caixa SET caxVlrEntrada = '$valor', caxData = '$data',caxHora = '$hora' WHERE caxCodigo = '$caxPedido'");}
          // ##  FINAL DE ROTINA ## //


          // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
          mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");


          // ALTERA O PONTEIRO PARA MUDAR DE ARQUIVO APÓS SALVAR A FORMA DE PAGAMENTO //
          mysql_query("UPDATE ponteiro SET ponPonteiro = 5, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel = '$usuario'");

        if(empty($sql))
        {
            print 0;
        }

        else
        {
            print 1;
        }
?>