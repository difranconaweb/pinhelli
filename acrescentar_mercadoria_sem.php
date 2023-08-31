<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS PARA ACRESCENTAR ITEM DO PEDIDO  */
     require 'Utilidades/conexao.php';

     $data = Date('d/m/Y');
     $dia  = Date('d');
     $mes  = Date('m');
     $ano  = Date('Y');


     $mercadoria       = $_GET['mercadoria'];
     $marca            = $_GET['marca'];
     $quantidade       = $_GET['quantidade'];
     $preco            = $_GET['preco'];
     $total            = $_GET['total'];
     $usuario          = $_GET['usuario'];
     $pedido           = $_GET['pedido'];
     $idCliente        = $_GET['idCliente'];
     $valorPedido      = $_GET['valorPedido'];

     

     
              //  INSERE NA TABELA DE ITENS O QUE FOI SELECIONADO  //
              mysql_query("INSERT INTO pedido_itens (pedIteQuantidade,pedIteDescricao,pedItePreco,pedIteTotal,pedIteResponsavel,pedIteData,pedItePedido_fk,
                pedIteCliente_fk,pedIteIdProduto_fk,pedIteDia,pedIteMes,pedIteAno)
               VALUES ('$quantidade','$mercadoria','$preco','$total','$usuario','$data','$pedido','$idCliente', '$id','$dia','$mes','$ano')");


            
               //  FAZ A SOMA DO VALOR E ATUALIZA A TABELA DE PEDIDO //
               $vl = mysql_query("SELECT SUM(pedIteTotal) AS VALOR, pedDesconto from pedido_itens RIGHT JOIN pedidos ON pedidos.pedCodigo = pedido_itens.pedItePedido_fk WHERE pedItePedido_fk = '$pedido'");
               while($objVl = mysql_fetch_array($vl))
               {
                    $valorPedidoNovo = $objVl['VALOR'];
                    $objDesconto     = $objVl['pedDesconto'];
               }

               //  ## AGORA FAZ A DIFERENÇA E MANDA PARA A QUERY PARA ATUALIZAR A TABELA  ##  //
               $valorPedidoNovo = ($valorPedidoNovo - $objDesconto);

               mysql_query("UPDATE pedidos SET pedValor = '$valorPedidoNovo', pedPedido_fk = 0 WHERE pedCodigo = '$pedido'");

       
?>