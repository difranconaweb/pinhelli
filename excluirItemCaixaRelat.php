<?php

/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


     ARQUIVO PARA EXCLUSÃO DE REGISTRO DO CAIXA NO SISTEMA PARTINDO DO RELATÓRIO  */


     session_start();
     $usuario = $_SESSION['usuario'];

     require 'Utilidades/conexao.php';

  // ## RECEBENDO DADOS DO FORMULÁRIO  ## //
     $codigo   = $_GET['codigo'];

     
     
  // ## PEGANDO DATA E HORA DO SERVIDOR ## //
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     

  // ## EXCLUINDO REGISTRO DA TABELA DO CAIXA ## //
 mysql_query("DELETE FROM caixa WHERE caxCodigo = '$codigo'");
 
 header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');
?> 