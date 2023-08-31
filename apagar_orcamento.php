<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 ####   ARQUIVO PARA APAGAR ORÇAMENTO  ###  */
     require 'Utilidades/conexao.php';

     $orcamento = $_GET['orcamento'];
     $usuario   = $_GET['usuario'];

    $sql      =  mysql_query("DELETE FROM orcamento WHERE orcCodigo = '$orcamento'");
    $sqlItens =  mysql_query("DELETE FROM orcamento_itens WHERE orcitens_fk = '$orcamento'");

        mysql_query("DELETE FROM $usuario WHERE Codigo = '$orcamento'"); //
    

     if(empty($sql) || empty($sqlItens))
     {
          print 0;
     }

     else
     {
          print 1;
     }
?>