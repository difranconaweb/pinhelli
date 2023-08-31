<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 10JUN23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 10JUN23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 10JUM23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 12JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS PARA APAGAR ITEM DO PEDIDO  */
     require 'Utilidades/conexao.php';

     $pedido  = $_GET['pedido'];  // TRAZ O NÚMERO DO PEDIDO  //
     $usuario = $_GET['usuario'];  // TRAZ O NOME DO USUÁRIO  //

     
     $ite = mysql_query("SELECT pedIteItem_fk, pedIteQuantidade FROM pedido_itens WHERE pedItePedido_fk = '$pedido'");
     $linhas = mysql_num_rows($ite);  // ENCONTRA A QUANTIDADE DE LINHAS DESTE PEDIDO //

     for($x=0; $x < $linhas; $x++)  // FOR PARA RODAR A QUANTIDADE DE VEZES CORRESPONDENTE A QUANTIDADE DE REGISTROS NA TABELA DE ITENS //
     {
           $ite = mysql_query("SELECT pedIteItem_fk, pedIteQuantidade FROM pedido_itens WHERE pedItePedido_fk = '$pedido'");
           while($d = mysql_fetch_array($ite))
           {
                 $idItem   = $d['pedIteItem_fk'];   //  BUSCA O ID DO ITEM NA TABELA DE ITENS //
                 $quant    = $d['pedIteQuantidade'];   //  BUSCA A QUANTIDADE DESTE ITEM QUE FOI COLOCADO PARA A VENDA E QUE SERÁ DEVOLVIDO //
           } 

           $me = mysql_query("SELECT merQuantidade FROM mercadorias WHERE merCodigoProduto LIKE '$idItem'");  // BUSCA A QUANTIDADE EM ESTOQUE  //
           while($ob = mysql_fetch_array($me))
           {
                 $quantidade = $ob['merQuantidade'];   // VALOR QUE ESTÁ NO ESTOQUE  //
           }

           $quantidade = ($quantidade + $quant);   // SOMA O ESTOQUE COM A QUANTIA QUE SERÁ DEVOLVIDA //

           // ATUALIZA A TABELA DE ESTOQUE  //
          $sql =  mysql_query("UPDATE mercadorias  SET merQuantidade = '$quantidade' WHERE merCodigoProduto LIKE '$idItem'");  
           
           // APAGA O (ITEM DA TABELA DE ITENS DE PEDIDO  //
           mysql_query("DELETE FROM pedido_itens WHERE pedIteItem_fk LIKE '$idItem' AND pedItePedido_fk = '$pedido'");
     }


    // REMOVE FINALMENTE O PEDIDO DA TABELA PRINCIPAL
    $sql =  mysql_query("DELETE FROM pedidos WHERE pedCodigo = '$pedido'"); 

    // REMOVE O PEDIDO DA TABELA DE PAGAMENTOS //
    mysql_query("DELETE FROM pagamentos WHERE pagPedido_fk = '$pedido'");     

    // REMOVE O PEDIDO DA TABELA DE CAIXA SE HOUVER //
    mysql_query("DELETE FROM caixa WHERE caxIdPedido_fk = '$pedido'");

    // ATUALIZANDO A TABELA DE PONTEIRO //
    mysql_query("UPDATE ponteiro SET ponPonteiro = 5 WHERE ponResponsavel = '$usuario'");

    // ATUALIZANDO A TABELA DE PONTEIRO //
    mysql_query("DELETE FROM $usuario");


    // ## BUSCANDO NUMERO DO ULTIMO PEDIDO PARA ESTE USUÁRIO ##
       $ped = mysql_query("SELECT pedCodigo, pedCliente_fk FROM pedidos  WHERE pedResponsavel = '$usuario'");  
       while($obj = mysql_fetch_array($ped))
       {
          $codigoCliente = $obj['pedCliente_fk'];
          $codigoPedido  = $obj['pedCodigo'];
       }
       // ## FINAL DE BUSCA ## //

       // ## ATUALIZANDO A TABELA DE CONTAINER PEDIDOS ## //
        mysql_query("UPDATE container_pedido SET conCodigoCliente = '$codigoCliente', conCodigoPedido_fk = '$codigoPedido' WHERE conResponsavel = '$usuario'");
       // ## FINAL DE ATUALIZAÇÃO DA TABELA DE CONTAINER PEDIDO ## //

     //  VERIFICA SE A QUERY NAO VOLTOU VAZIA/ERRO E RESPONDE AO USUÁRIO COM JAVASCRIPT  //
     if(empty($sql))
     {
          print 0;
     }

     else
     {
          print 1;
     }
?>