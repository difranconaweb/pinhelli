<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA REGISTRO DE GRUPOS */
     
     require 'Utilidades/conexao.php';
     session_start();   // INICIA A SESSÃO //
     $usuario = $_SESSION['usuario']; // CARREGA O NOME DO USUÁRIO //
     $grupo = strtoupper($_GET['grupo']);  // CARREGA O NOME DO GRUPO A SER CRIADO //
     $data  = date('d/m/Y');   // CARREGA A DATA DESTE REGISTRO //
     $hora  = date('H:i:s');   // CARREGA A HORA DESTE REGISTRO //

     //  ESTA LINHA SALVA O GRUPO A SER CRIADO  //

     $sql = mysql_query("SELECT gruNome FROM grupo WHERE gruNome = '$grupo'");
     while($obj = mysql_fetch_array($sql))
     {
          $nome = $obj['gruNome'];
     }

     if($nome == $grupo)
     {
            print 0;
     }

     else
     {
            mysql_query("INSERT INTO grupo (gruData, gruResponsavel, gruNome, gruHora) VALUES ('$data','$usuario','$grupo','$hora')");
            print 1;
     }
?>