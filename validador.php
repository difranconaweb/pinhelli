<?php
  /* SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
  
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

    ROTINA DE VALIDAÇÃO DE ID DE GRUPO EM CADASTRO DE MERCADORIAS  */

// ############################################################################################################################ //
//     ESTE ARQUIVO CARREGA O ID DO GRUPO SELECIONADO PARA MUDAR  AO CLICAR NO NOVO GRUPO    //
// ############################################################################################################################ //

     session_start();
     require 'Utilidades/conexao.php';

     $codigo  = $_REQUEST['objCodigo']; // CODIGO DA MERCADORIA //
     $grupo   = $_REQUEST['objGrupo']; // CODIGO DO GRUPO //
     $usuario = $_SESSION['usuario'];  // VARIÁVEL DE SESSÃO, QUE VEM COM O NOME DO USUÁRIO LOGADO //



     $sql = mysql_query("UPDATE mercadorias SET merGrupo = '$grupo' WHERE merCodigo = '$codigo'");

     // ## VERIFICA SE HOUVE ERRO ## //
     if(empty($sql))
     { 
         print 0;
     }

     else
     {
        print 1;
     }
     

     header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');


     

?>