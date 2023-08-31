<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 31MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 05AGO23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO  - OPÇÃO 3 PAGAMENTO A VISTA */
     require 'Utilidades/conexao.php';

     $pedido      = $_GET['pedido'];
     $idCliente   = $_GET['id_cliente'];
     $valor       = $_GET['valor'];
     $usuario     = strtoupper($_GET['usuario']);
     $km          = $_GET['km'];
     $desconto    = $_GET['desconto'];
     $mecanico    = strtoupper($_GET['mecanico']);
     $pagamento   = $_GET['pagamento'];
     $garantia    = strtoupper($_GET['garantia']);
     $comentario  = strtoupper($_GET['comentario']);
     
     
     
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

    if(empty($cliente)) //  CASO NÃO HAJA CLIENTE, VOLTA COM MENSAGEM DE EXCESSAO //
    {
          print  2;
    }

    else
    {// ALTERAR O REGISTRO QUE JÁ FOI CRIADO AO SALVAR O PEDIDO //
         $sql = mysql_query("UPDATE pedidos SET pedCliente_fk = '$idCliente', pedValor = '$valor', pedDesconto = '$desconto', pedPedido_fk = 2, pedData = '$data', pedHora = '$hora', pedKm = '$km', pedGarantia = '$garantia', pedComentario = '$comentario', pedMecanico = '$mecanico', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'");
         mysql_query("UPDATE container_pedido SET conStatus = 1");
             // APÓS REGISTRAR O VALOR DO PEDIDO INSERE O VALOR DO DESCONTO, BEM COMO A KM  //
         mysql_query("UPDATE pedido_itens SET pedIteKm = '$km', pedIteMecanico = '$mecanico' WHERE pedItePedido_fk = '$pedido'");


         // INSERE O METODO DE PAGAMENTO NA TABELA DE PAGAMENTO  //
         mysql_query("INSERT INTO carteira (pagCliente_fk, pagPedido_fk, pagStatus, pagFormaPagto, pagBandeira, pagParcela, pagDataPag, pagValor, pagData, pagHora, pagResponsavel) VALUES ('$idCliente', '$pedido', 'FECHADO', 3, 'DINHEIRO','1', '$data','$valor','$data','$hora','$usuario')");

         // INSERE O PEDIDO COM PAGAMENTO A VISTA NA TABELA DE CAIXA //
         mysql_query("INSERT INTO caixa (caxIdPedido_fk, caxDescricao, caxVlrEntrada, caxVlrSaida, caxData, caxHora, caxResponsavel)  VALUES ('$pedido','PEDIDO A VISTA ..: $pedido','$valor','','$data','$hora','$usuario')");

         // ATUALIZA A TABELA DE CONTAINER DE PEDIDO //
         mysql_query("UPDATE container_pedido  SET conStatus = 1, conCodigoPedido_fk = '$pedido' WHERE conResponsavel = '$usuario'");



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