<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 22MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

// ############################################################################################  //
/* ### ARQUIVO PARA PONTEIRO DE PEDIDOS  - SEMPRE QUE VIER DO MENU, ESTE ARQUIVO VAI ATUALIZAR 
       A TABELA DE CONTAINER_PEDIDO PARA O ÚLTIMO PEDIDO DA TABELA, PARA QUE NÃO FIQUE PRESO
       NA ÚLTIMA PESQUISA ###  */
// ############################################################################################  //
require 'Utilidades/conexao.php';

    session_start(); // INICIANDO A SESSÃO
    $usuario = $_SESSION['usuario'];
    $dt = Date('d/m/Y');  // PEGANDO A DATA ATUAL NO SERVIDOR //
    $hr = Date('H:i:s');  /* PEGA A HORA NO SERVER */


// ##  BUSCA O ULTIMO REGISTRO PARA CARREGAR A TABELA DE CONTAINER_PEDIDO COM OS DADOS  ## //
   $sql = mysql_query("SELECT pedCodigo, pedCliente_fk, logCodigo FROM pedidos LEFT JOIN login ON login.logNome = pedidos.pedResponsavel");
   while($obj = mysql_fetch_array($sql))
   {
        $pedCodigo     = $obj['pedCodigo'];      // INFORMA O ID DO PEDIDO //
        $pedCliente_fk = $obj['pedCliente_fk'];  // INFORMA O ID DO CLIENTE //
        $logCodigo     = $obj['logCodigo'];      // ID DO CLIENTE //
   }

   /* ## ESTA QUERY VEM PAR ATUALIZAR O USUARIO LOGADO, PORQUE A QUERY ACIMA INSERE O LOG DO RESPONSAVEL DO ÚLTIMO PEDIDO, PORTANTO NEM SEMPRE COINCIDE. */
   $_sql = mysql_query("SELECT logCodigo FROM login WHERE logNome LIKE '$usuario'");
   while($_obj = mysql_fetch_array($_sql))
   {
       $user = $_obj['logCodigo'];
   }





// ###  QUERY QUE ATUALIZA A TABELA CONTAINER_PEDIDO  ###  //
    mysql_query("UPDATE container_pedido SET conStatus = 1, conCodigoCliente = '$pedCliente_fk', conCodigoPedido_fk = '$pedCodigo', data = '$dt' WHERE conResponsavel LIKE '$usuario'");
// ### ATUALIZA A TABELA PONTEIRO PARA A OPÇÃO 5 DA ROTINA CONTROLLER.PHP  ### //
    mysql_query("UPDATE ponteiro SET ponPonteiro = 5, ponPesquisa = '', ponIDUser_fk = '$user', ponData = '$dt', ponHora = '$hr' WHERE ponResponsavel LIKE '$usuario'");
    
    if(empty($usuario))
    {
        // APONTA PARA O ARQUIVO DE CONTROLE //
        header('Location:http://www.difranconaweb.com.br/pinhelli/index.php');
    }

    else
    {
        // ##  ESTA LINHA VAI SEMPRE ZERAR A TABELA DE PONTEIRO PARA QUE NÃO FAÇA APONTAMENTO DESNECESSÁRIO ## //
        mysql_query("UPDATE ponteiro SET ponPesquisa = '' WHERE ponResponsavel LIKE '$usuario'");    
        // APONTA PARA O ARQUIVO DE CONTROLE APÓS ZERA A TABELA PONTEIRO //
        header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');    
    }
?>  