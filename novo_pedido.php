<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 08JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 11JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 13JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE NOVO PEDIDO  */
     require 'Utilidades/conexao.php';


     $data    = Date('d/m/Y');
     $hora    = Date('H:i:s');
     $dia     = Date('d'); $mes = Date('m'); $ano = Date('Y');
     $usuario = $_GET['usuario'];

    
     // ## ESTA ROTINA INFORMA SE O ULTIMO PEDIOD ESTÁ AINDA ABERTO OU FECHADO  ## //
     
     // ## ESTA QUERY VAI VERIFICAR SE O PEDIDO ESTÁ EM ABERTO OU ESTÁ FECHADO  DESDE QUE SEJA DO RESPONSAVEL ## //
     $sql = mysql_query("SELECT pedPedido_fk, pedResponsavel FROM pedidos WHERE pedResponsavel LIKE '$usuario'");

     while($obj = mysql_fetch_array($sql))
     {
          $fechado = $obj['pedPedido_fk'];
          $objResp = $obj['pedResponsavel'];
     }
     //  FINAL DE VERIFICAÇÃO DE PEDIDOS ABERTO/FECHADO DO RESPONSAVEL  //

     
     // RESETANDO AS VARIÁVEIS //
     $sql = ""; $obj = "";
     

     if($fechado == 0)
     {
          print 0;
     }

     else
     {
          // INSERE O NOVO PEDIDO //
          mysql_query("INSERT INTO pedidos (pedHora,pedData,pedResponsavel,pedPedido_fk) VALUES ('$hora','$data','$usuario',0)");
          
          // BUSCA O NÚMERO DO NOVO PEDIDO CRIADO PARA SER ENVIADO NA URL //*/
          $_sql = mysql_query("SELECT pedCodigo FROM pedidos");
          while($_obj = mysql_fetch_array($_sql))
          {
               $codigo = $_obj['pedCodigo'];
          }
         

          // ## NESTA ROTINA INSERE O VALOR DO ARQUIVO QUE DEVE SER DIRECIONADO COMO PONTEIRO  ## //
          mysql_query("UPDATE ponteiro SET ponPonteiro = 21, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel = '$usuario'");

          // ## ATUALIZANDO A TABELA DE CONATINER_PEDIDO PARA SABER QUAL O CLIENTE DEVE CARREGAR NA TELA  ## //
          mysql_query("UPDATE container_pedido SET conCodigoCliente = 2, conStatus = 0, conCodigoPedido_fk = '$codigo' WHERE conResponsavel LIKE '$usuario'"); /*  */// ATUALIZA A TABELA DE CONTAINER_PEDIDO COM O NOVO PEDIDO E TAMBÉM COLOCA O VALOR ZERO NA COLUNA PARA O ID  DO CLIENTE DEVIDO AINDA NÃO TER SIDO PESQUISADO O CLIENTE PARA ESTE NOVO PEDIDO BEM COMO CONSTATUS RECEBE O VALOR 2 PARA NOVO PEDIDO //


          // ESTE TRECHO É O COMEÇO DA IA PARA O REGISTRO DE UM PEDIDO DE CADA VENDEDOR SIMULTANEAMENTE //
/*##############################################################################################################################*/
mysql_query("CREATE TABLE IF NOT EXISTS $usuario (Codigo INT(10)NOT NULL, Cliente_fk INT(10) NOT NULL, Codigo_fk CHAR(20) NOT NULL, coringa CHAR(20) NOT NULL, Hora CHAR(8)NOT NULL, Data CHAR(10) NOT NULL, Responsavel CHAR(20) NOT NULL, Valor DOUBLE(8,2) NOT NULL, Desconto DOUBLE(8,2) NOT NULL, Pedido_fk INT(5) NOT NULL, Orcamento_fk INT(5) NOT NULL, Km CHAR(20) NOT NULL, Garantia CHAR(20) NOT NULL, Comentario VARCHAR(100) NOT NULL, Dia CHAR(2) NOT NULL, Mes CHAR(2) NOT NULL, Ano CHAR(4) NOT NULL, reg_date TIMESTAMP)");


// ### CASO HAJA REGISTRO NA TABELA TEMPORÁRIA, DEVE SER LIMPA PARA EVITAR PROBLEMAS DE DUPLICIDADE  ### //
mysql_query("DELETE FROM $usuario");
// ABRINDO O PRIMEIRO REGISTRO COM O NUMERO ID DO REGISTRO CRIADO NA TABELA MATRIZ. O ID DA MATRIZ ESTÁ EM CAMPO DE  FK //
mysql_query("INSERT INTO $usuario (Codigo, Codigo_fk, Hora, Data, Pedido_fk, Responsavel, Garantia, Dia, Mes, Ano) VALUES ('$codigo','$codigo','$hora','$data','$codigo','$usuario', '3', '$dia','$mes','$ano')");
        
          print 1;
     }

?>