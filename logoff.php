<?php

/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 18JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


     ARQUIVO DE LOGOFF DO SISTEMA PINHELLI PNEUS E SUSPENSAO  */
          
          session_start();
          require 'Utilidades/conexao.php';

          $usuario = $_SESSION['usuario'];


          $data = Date('d/m/Y');  // CARREGA A DATA
          $hora = Date('H:i:s');  // CARREGA A HORA
           
          mysql_query("UPDATE login SET logLogin = 0, logDataOff = '$data', logTimeOff = '$hora' WHERE logApelido LIKE '$usuario'");
          mysql_query("UPDATE ponteiro SET ponPonteiro = 0, ponDataInicial = '', ponDataFinal = '', ponData = '$data', ponHora = '$hora'  WHERE ponResponsavel LIKE '$usuario'");
          mysql_query("DROP TABLE $usuario");
          session_destroy();
          header('Location:http://www.difranconaweb.com.br/pinhelli/index.php');
          
?>