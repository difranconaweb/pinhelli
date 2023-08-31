<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 13JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA DIRECIONAR AO PEDIDO  */   

     require 'Utilidades/conexao.php';


     $data    = Date('d/m/Y');
     $hora    = Date('H:i:s');
     $usuario = $_GET['usuario'];


     // BUSCANDO O ID DO CLIENTE QUE ACABOU DE SER CADASTRADO //
     $_sql = mysql_query("SELECT cliCodigo FROM clientes");
     while($_obj = mysql_fetch_array($_sql))
     {
         $cliCodigo = $_obj['cliCodigo'];
     }

     // INSERE O NOVO PEDIDO //
          mysql_query("INSERT INTO pedidos (pedCliente_fk,pedHora,pedData,pedResponsavel,pedPedido_fk) VALUES ('$cliCodigo','$hora','$data','$usuario',0)");
          
          // BUSCA O NÚMERO DO NOVO PEDIDO CRIADO PARA SER ENVIADO NA URL //*/
          $sql = mysql_query("SELECT pedCodigo FROM pedidos");
          while($obj = mysql_fetch_array($sql))
          {
               $codigo = $obj['pedCodigo'];
          }
          
          mysql_query("UPDATE container_pedido SET conCodigoCliente = $cliCodigo, conStatus = 1, data = '$data', conCodigoPedido_fk = '$codigo' WHERE conResponsavel = '$usuario'"); // ATUALIZA A TABELA DE CONTAINER_PEDIDO COM O NOVO PEDIDO E TAMBÉM COLOCA O VALOR ZERO NA COLUNA PARA O ID DO CLIENTE DEVIDO AINDA NÃO TER SIDO PESQUISADO O CLIENTE PARA ESTE NOVO PEDIDO BEM COMO CONSTATUS RECEBE O VALOR 2 PARA NOVO PEDIDO //

          /* ## NESTA ROTINA INSERE O VALOR DO ARQUIVO QUE DEVE SER DIRECIONADO COMO PONTEIRO  ## */
          mysql_query("UPDATE ponteiro SET ponPonteiro = 21, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel LIKE '$usuario'");    

          header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');                                              

?>