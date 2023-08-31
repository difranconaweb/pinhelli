<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 20JUL23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 20JUL23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 20JUL23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 21JUL23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO DÉBITO */
     require 'Utilidades/conexao.php';

     $pedido     = $_GET['pedido'];
     $valor      = $_GET['valor'];
     $valor1     = $_GET['valor1'];
     $valor2     = $_GET['valor2'];
     $idCliente  = $_GET['id_cliente'];
     $usuario    = strtoupper($_GET['usuario']);
     $km         = $_GET['km'];
     $desconto   = $_GET['desconto'];
     $opcao      = strtoupper($_GET['opcao']);
     $opcao1     = strtoupper($_GET['opcao1']);
     $mecanico   = strtoupper($_GET['mecanico']);
     $garantia   = strtoupper($_GET['garantia']);
     $comentario = strtoupper($_GET['comentario']);
     $desconto   = str_replace(',','.',$desconto);
     $valor      = str_replace(',', '.',$valor);
     $valor1     = str_replace(',', '.',$valor1);
     $valor2     = str_replace(',', '.',$valor2);
// PEGA O VALOR DO PEDIDO BEM COMO O DESCONTO E LANÇA O VALOR REAL NA TABELA //
     $valor = ($valor - $desconto); // VALOR COM O DESCONTO //

      
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


     $cli = mysql_query("SELECT pedCliente_fk FROM pedidos WHERE pedCodigo = '$pedido'");
     while($ob = mysql_fetch_array($cli))
     {
         $cliente = $ob['pedCliente_fk']; //  VERIFICA ANTES DE SALVAR SE HÁ CLIENTE SALVO NA TABELA  //
     }


 // ## OPÇÃO PARA PAGAMENTO..: 0 - SELECIONE / 1 - CARTEIRA / 2 - DÉBITO / 3 - DINHEIRO / 4 - CARTAO CRÉDITO / 5 - PIX ## //
     if(empty($cliente)) //  CASO NÃO HAJA CLIENTE, VOLTA COM MENSAGEM DE EXCESSAO //
     {
          print  2;
     }

     else
     {// ALTERAR A FORMA DE PAGAMENTO //
        $sql = mysql_query("INSERT INTO carteira (pagCliente_fk, pagPedido_fk, pagStatus, pagFormaPagto, pagBandeira, pagOpcao, pagOpcao1, pagParcela, pagValor, pagValor1, pagValor2, pagDataPag, pagData, pagHora, pagResponsavel) VALUES ('$idCliente', '$pedido', 'FECHADO', 1, 'DIVIDIDO', '$opcao', '$opcao1', 6, '$valor', '$valor1', '$valor2', '$data', '$data','$hora','$usuario')");

          mysql_query("UPDATE pedidos SET pedValor = '$valor', pedValor1 = '$valor1', pedValor2 = '$valor2', pedDesconto = '$desconto', pedOpcao = '$opcao', pedOpcao1 = '$opcao1', pedHora = '$hora', pedPedido_fk = 2, pedKm = '$km', pedGarantia = '$garantia', pedComentario = '$comentario', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano'WHERE pedCodigo = '$pedido'");  // FECHA O PEDIDO NA TABELA DE PEDIDOS //

          // ATUALIZANDO A TABELA DE PEDIDO DEDICADA DO USUARIO  //
          mysql_query("UPDATE $usuario SET Total = '$valor', Desconto = '$desconto', Mecanico = '$mecanico'");
     
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
          mysql_query("INSERT INTO caixa (caxIdPedido_fk, caxDescricao, caxVlrEntrada, caxVlrSaida, caxData, caxHora, caxResponsavel)  VALUES ('$pedido','PAGAMENTO DIVIDIDO ..: $pedido','$valor','','$data','$hora','$usuario')");}else{mysql_query("UPDATE caixa SET caxVlrEntada = '$valor', caxData = '$data',caxHora = '$hora' WHERE caxCodigo = '$caxPedido'");}
          // ##  FINAL DE ROTINA ## //


          // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O MECANICO  //
          mysql_query("UPDATE pedido_itens SET  pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");


          // ALTERA O PONTEIRO PARA MUDAR DE ARQUIVO APÓS SALVAR A FORMA DE PAGAMENTO //
          mysql_query("UPDATE ponteiro SET ponPonteiro = 5, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel = '$usuario'");

         print 1;
     }
?>