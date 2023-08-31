<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

    
    ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS - SALVAR O PEDIDO  */
     require 'Utilidades/conexao.php';

     $pedido    = $_GET['pedido'];
     $idCliente = $_GET['id_cliente'];
     $valor     = $_GET['valor'];
     $usuario   = strtoupper($_GET['usuario']);
     $valor     = str_replace(',','',$valor);// TRANTANDO A VARIÁVEL COM O VALOR DO TÍTULO, REMOVENDO PONTOS     
     
     
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


    
    // ALTERAR O REGISTRO QUE JÁ FOI CRIADO AO SALVAR O PEDIDO //
     $sql = mysql_query("UPDATE pedidos SET pedCliente_fk = '$idCliente', pedValor = '$valor', pedPedido_fk = 2, pedHora = '$hora', pedData = '$data', pedDia = '$dia', pedMes = '$mes', pedAno = '$ano' WHERE pedCodigo = '$pedido'");
         
      // MUDA O STATUS PARA A  CONDIÇÃO DA TELA //
      mysql_query("UPDATE container_pedido SET conStatus = 3");
     
      // INSERE O METODO DE PAGAMENTO NA TABELA DE PAGAMENTO  //
      mysql_query("UPDATE pagamentos SET pagCliente_fk = '$idCliente', pagStatus = 'FECHADO',  pagFormaPagto = 3, pagBandeira = 'DINHEIRO', pagParcela = 1, pagDatapag = '$data', pagValor = '$valor', pagData = '$data', pagHora = '$hora', pagResponsavel = '$usuario' WHERE pagPedido_fk = '$pedido'");


        if(empty($sql))
        {
           print 0;
        }

        else
        {
           print 1;
        }
?>