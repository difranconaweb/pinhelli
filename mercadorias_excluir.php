<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA EXCLUSÃO DE REGISTRO DE MERCADORIAS */
     
     require 'Utilidades/conexao.php';
  
     $data = Date('d/m/Y');


     $codigo = $_GET['codigo'];


     $sql = mysql_query("UPDATE mercadorias SET merExcluir = 1, merUltimaAlteracao = '$data' WHERE merCodigoProduto LIKE '$codigo'");


     if(empty($sql))
     {
         print 0;
     }

     else
     {
         print 1;
     }
?>