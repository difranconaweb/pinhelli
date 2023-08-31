<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 ####   ARQUIVO PARA FECHAR ORÇAMENTO  ###  */
    session_start();
    require 'Utilidades/conexao.php';


    $data = Date('d/m/Y');
    $usuario     = $_GET['usuario'];
    $orcamento   = $_GET['orcamento'];

    $sql = mysql_query("UPDATE orcamento SET orcData = '$data', orcResponsavel = '$usuario', orcPedido_fk = 1 WHERE orcCodigo = '$orcamento'");
           mysql_query("UPDATE container SET conStatus = 1");
           

    if(empty($sql))
    {
           print 0;
    }

    else
    {  
           mysql_query("INSERT INTO orcamento (orcData,orcResponsavel,orcPedido_fk) VALUES ('$data','$usuario',0)");
           print 1;
    }


?>