<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 ####   ARQUIVO PARA INSERIR NOVO ORÇAMENTO  ###  */
     require 'Utilidades/conexao.php';
     $data    = Date('d/m/Y');
     $hora    = Date('H:i:s');
     $dia     = Date('d'); $mes = Date('m'); $ano = Date('Y');
     $usuario = $_GET['usuario'];

     

     // ## ESTA QUERY VAI VERIFICAR SE O ORÇAMENTO ESTÁ EM ABERTO OU ESTÁ FECHADO  DESDE QUE SEJA DO RESPONSAVEL ## //
     $sql = mysql_query("SELECT orcPedido_fk, orcResponsavel, orcFechado FROM orcamento WHERE orcResponsavel LIKE '$usuario'");

     while($obj = mysql_fetch_array($sql))
     {
          $gerado  = $obj['orcPedido_fk'];
          $objResp = $obj['orcResponsavel'];
          $fechado = $obj['orcFechado'];
     }
     //  FINAL DE VERIFICAÇÃO DE ORÇAMENTO ABERTO/FECHADO DO RESPONSAVEL  //

     
     // RESETANDO AS VARIÁVEIS //
     $sql = ""; $obj = "";
     

          // INSERE O NOVO ORÇAMENTO //
          mysql_query("INSERT INTO orcamento (orcCliente_fk, orcHora, orcData, orcResponsavel, orcGarantia, orcComentario, orcPedido_fk) VALUES ('','$hora', '$data','$usuario', '3', 'ORCAMENTO VALIDO POR 20 DIAS', 0)");
          
          // BUSCA O NÚMERO DO NOVO ORÇAMENTO CRIADO PARA SER ENVIADO NA URL //*/
          $sql = mysql_query("SELECT orcCodigo FROM orcamento");
          while($obj = mysql_fetch_array($sql))
          {
               $codigo = $obj['orcCodigo'];
          }
          // ESTAVA COM O VALOR ZERO NO CONSTATUS  //
          mysql_query("UPDATE container SET conCodigoCliente = '$codigo', conStatus = 0, conCodigoOrcamento_fk = '$codigo', data = '$data' WHERE conResponsavel LIKE '$usuario'"); // ATUALIZA A TABELA DE CONTAINER COM O NOVO ORÇAMENTO E TAMBÉM COLOCA O VALOR ZERO NA COLUNA PARA O ID DO CLIENTE DEVIDO AINDA NÃO TER SIDO PESQUISADO O CLIENTE PARA ESTE NOVO ORÇAMENTO BEM COMO CONSTATUS RECEBE O VALOR 2 PARA NOVO ORÇAMENTO //

          // ## NESTA ROTINA INSERE O VALOR DO ARQUIVO QUE DEVE SER DIRECIONADO COMO PONTEIRO  ## //
          mysql_query("UPDATE ponteiro SET ponPonteiro = 17, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel LIKE '$usuario'");


//##############################################################################################################################//
          // ESTE TRECHO É O COMEÇO DA IA PARA O REGISTRO DE UM ORÇAMENTO DE CADA VENDEDOR SIMULTANEAMENTE //
//##############################################################################################################################//
mysql_query("CREATE TABLE IF NOT EXISTS $usuario (Codigo INT(5) AUTO_INCREMENT PRIMARY KEY, Cliente_fk INT(5) NOT NULL, Codigo_fk INT(5) NOT NULL, Hora CHAR(8)NOT NULL, Data CHAR(10) NOT NULL, Responsavel CHAR(20) NOT NULL, Valor DOUBLE(8,2) NOT NULL, Desconto DOUBLE(8,2) NOT NULL, Pedido_fk INT(5) NOT NULL, Km CHAR(20) NOT NULL, Garantia CHAR(20) NOT NULL, Comentario VARCHAR(100) NOT NULL, Dia CHAR(2) NOT NULL, Mes CHAR(2) NOT NULL, Ano CHAR(4) NOT NULL, Orcamento_fk INT(1) NOT NULL, reg_date TIMESTAMP)");

// ABRINDO O PRIMEIRO REGISTRO COM O NUMERO ID DO REGISTRO CRIADO NA TABELA MATRIZ. O ID DA MATRIZ ESTÁ EM CAMPO DE  FK //
mysql_query("INSERT INTO $usuario (Codigo, Codigo_fk, Hora, Data, Responsavel, Garantia, Dia, Mes, Ano) VALUES ('$codigo','$codigo','$hora','$data','$usuario', '3', '$dia','$mes','$ano')");

          
          print 1; // DEVOLVE PARA A FUNÇÃO JS //
     
?>