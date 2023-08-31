<?php
  /* SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
  
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

    ROTINA DE PEDIDOS - SEGUNDA PÁGINA  */

// ############################################################################################################################ //
//     ESTE ARQUIVO VEM PARA CARREGAR O ID DO CLIENTE SELECIONADO E SALVA-LO EM UMA TABELA PARA ABRIR O FORMULÁRIO DE PEDIDOS   //
// ############################################################################################################################ //

     session_start();
     require 'Utilidades/conexao.php';

     $codigo  = $_REQUEST['objCodigo']; // CODIGO DO CLIENTE //
     $usuario = $_SESSION['usuario'];  // VARIÁVEL DE SESSÃO, QUE VEM COM O NOME DO USUÁRIO LOGADO //



     mysql_query("UPDATE container_pedido SET conCodigoCliente = '$codigo' WHERE conResponsavel = '$usuario'");

     // ###  PEGANDO O NÚMERO DO PEDIDO ### //
     $sql = mysql_query("SELECT pedCodigo FROM pedidos");
     while($obj = mysql_fetch_array($sql))
     {
         $pedido = $obj['pedCodigo'];
     }

     // ## INSERE NA TABELA TEMPORARIA O NUMERO DO CLIENTE SELECIONADO ## // 
     mysql_query("UPDATE $usuario SET Cliente_fk = '$codigo', Hora = '$hora', Data = '$data'");

    // ##  ATUALIZA A TABELA DE PONTEIRO COM O ID DO CLIENTE ## //
    mysql_query("UPDATE ponteiro SET  ponPesquisa = '$pesquisar' WHERE ponResponsavel LIKE '$usuario'");
    // ##  FINAL DE ATUALIZAÇÃO DE TABELA DE PONTEIRO ## //

    //  ### INSERINDO O NUMERO DO CLIENTE   ### //
    mysql_query("UPDATE pedidos SET pedCliente_fk = '$codigo' WHERE pedCodigo = '$pedido'");

    header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');


     

?>