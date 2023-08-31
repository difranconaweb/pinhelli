<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645 */

// ### INICIO DE CONTROLE E DISTRIBUIÇÃO DE FUNÇÕES DE TODO O SISTEMA ###  //
require 'Utilidades/conexao.php';

    session_start(); // INICIA A SESSÃO //
    $ponteiro = $_REQUEST['sender']; // RECEBE NESTA VARIÁVEL O NOME DO USUARIO QUE VEM DO JAVASCRIPT NA PASTA MENU //
    $pesquisa = $_REQUEST['pesquisa']; // RECEBE NESTA VARIÁVEL O VALOR DA PESQUISA, QUE VEM COM O ID DO CLIENTE OU DA PESQUISA //
    $usuario  = $_SESSION['usuario']; // CARREGA A VARIÁVEL COM O VALOR DA SESSÃO //

    // PEGANDO O HORARIO E A DATA NO SERVIDOR //
    $data = Date('d/m/Y');
    $hora = Date('H:i:s');

    // ## BUSCA O ID DO USUÁRIO PARA UTILIZAR ABAIXO ## //
       $sql = mysql_query("SELECT logCodigo, logNome FROM login WHERE logNome = '$usuario'");
       while($obj = mysql_fetch_array($sql))
       {
          $objUsuario = $obj['logCodigo'];  // ID DO USUÁRIO  //
       }

    // ## SALVA O VALOR NA TABELA PARA INDICAR QUAL A TELA ## //
    /* VALOR - 1 PARA TELA DE MENU
       VALOR - 2 PARA TELA DE CLIENTES 
       VALOR - 3 PARA TELA DE FORNECEDOR
       VALOR - 4 PARA TELA DE MERCADORIAS
       VALOR - 5 PARA TELA DE PEDIDOS COM ESTOQUE
       VALOR - 6 PARA TELA DE ORÇAMENTOS
       VALOR - 7 PARA TELA DE ADMINISTRADOR
       VALOR - 8 PARA FUNÇÃO DE IMPRESSÃO
       VALOR - 9 PARA FUNÇÃO DE CAIXA
       VALOR - 10 PARA FUNÇÃO DE RELATÓRIO CLIENTES
       VALOR - 11 PARA FUNÇÃO DE RELATÓRIO FORNECEDORES
       VALOR - 12 PARA FUNÇÃO DE RELATÓRIO MERCADORIAS
       VALOR - 13 PARA FUNÇÃO DE RELATÓRIO CAIXA
       VALOR - 14 PARA FUNÇÃO DE RELATÓRIO PEDIDOS
       VALOR - 15 PARA FUNÇÃO DE RELATÓRIO INDEX
       VALOR - 16 PARA FUNÇÃO DE RELATÓRIO COBRANÇA 
       VALOR - 17 PARA TELA DE ORÇAMENTO IA
       VALOR - 18 FUNÇÃO DE IMPRESSÃO ORÇAMENTO IA
       VALOR - 19 PARA RELATÓRIO DE ORÇAMENTO 
       VALOR - 20 PARA ARQUIVO FAXINEIRO
       VALOR - 21 PARA TELA DE PEDIDOS SEM ESTOQUE */



       // ## FAZ UMA PESQUISA NA TABELA PEDIDO PARA CARREGAR O ID DO CLIENTE COM O ID DO PEDIDO PARA INSERI-LO NA TABELA DE CONTAINER_PEDIDO ## //
       $sql = mysql_query("SELECT pedCliente_fk FROM pedidos WHERE pedCodigo = '$pesquisa'");
       while($obj = mysql_fetch_array($sql))
       {
          $objCliente = $obj['pedCliente_fk'];  // ID DO CLIENTE NESTA LINHA  //
       }

       /****************************************************************************************************************/
        // ## FAZ UMA PESQUISA NA TABELA ORÇAMENTO PARA CARREGAR O ID DO CLIENTE COM O ID DO ORÇAMENTO PARA INSERI-LO NA TABELA DE CONTAINER ## //
       $_sql = mysql_query("SELECT orcCliente_fk FROM orcamento WHERE orcCodigo = '$pesquisa'");
       while($_obj = mysql_fetch_array($_sql))
       {
          $objClienteOrc = $_obj['orcCliente_fk'];  // ID DO CLIENTE NESTA LINHA  //
       }
       /****************************************************************************************************************/

    // ## ATUALIZA A TABELA DE PONTEIRO COM O NUMERO DO ORÇAMENTO OU POEDIDO E O NUMERO DO ARQUIVO ## //
    mysql_query("UPDATE ponteiro SET ponPonteiro = '$ponteiro', ponPesquisa = '$pesquisa', ponData = '$data', ponHora = '$hora' WHERE ponResponsavel = '$usuario'");

    // INSERE O ID DO PEDIDO NA TABELA DE CONTAINER_PEDIDO, POSSA PESQUISAR O REGISTRO/PEDIDO E CARREGAR NA TELA  //
    mysql_query("UPDATE container_pedido SET conTabela = 1, conStatus = 3, conCodigoCliente = '$objCliente', conCodigoPedido_fk = '$pesquisa' WHERE conResponsavel = '$usuario'");

    
    // ### INSERINDO VALOR DE PEDIDO NA TABELA TEMPORARIA  ### //
    mysql_query("UPDATE $usuario SET pedCodigo_fk = '$pesquisa', pedCliente_fk = '$objCliente'");

    // ######################################################################################################################## //
    // ###     SE VIER COM O PONTEIRO VALENDO - ENTÃO DEVERÁ DECIDIR O QUE FAZER                                            ### //
    // ######################################################################################################################## //
    // INSERE O ID DO ORCAMENTO NA TABELA DE CONTAINER, POSSA PESQUISAR O REGISTRO/ORÇAMENTO E CARREGAR NA TELA  //

    if($ponteiro == 20)// SE VIER VALENDO 20, PORQUE VEIO DO MENU VOLTAR DA ROTINA TEMPORÁRIA FAZER O ORÇAMENTO //
    {
       
                mysql_query("UPDATE container SET conTabela = 1, conStatus = 3, conCodigoOrcamento_fk = '$pesquisa', conCodigoCliente = '$objCliente' WHERE conResponsavel = '$usuario'");
                mysql_query("UPDATE ponteiro SET ponPonteiro = 20, ponTabela = 1, ponDataInicial = '$data', ponHora = '$hora'
                  WHERE ponResponsavel = '$usuario'");
    }

    else
    {
          mysql_query("UPDATE container SET conTabela = 1, conStatus = 0, conCodigoOrcamento_fk = '$pesquisa', conCodigoCliente = '$objCliente' WHERE conResponsavel = '$usuario'");
    }
        
    
    // APONTA PARA O ARQUIVO DE CONTROLE //
    header('Location:controller.php');
   // ## FINAL DE ENDEREÇAMENTO ## //
    
   

?>  