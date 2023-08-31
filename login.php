<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

  
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 18JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645  */


    // ARQUIVO DE LOGIN DO SISTEMA PINHELLI PNEUS E SUSPENSÃO  //
          session_start();
          require 'Utilidades/conexao.php';

          $data = Date('d/m/Y');  // CARREGA A DATA
          $hora = Date('H:i:s');  // CARREGA A HORA

          // PEGA OS VALORES E CARREGA AS VARIÁVEIS //
          $nome     = trim(strtoupper($_GET['nome']));
          $password = trim(strtolower($_GET['senha']));
          $senha    = sha1($password);  // CRIPTOGRAFA A SENHA //



          $sql = mysql_query("SELECT * FROM login  WHERE logNome LIKE '$nome' AND logSenha LIKE '$senha'");

          while($obj = mysql_fetch_array($sql))
          {
              $objCodigo  = $obj['logCodigo'];
              $objUsuario = $obj['logNome'];
              $objApelido = $obj['logApelido'];
              $objSenha   = $obj['logSenha'];
          }


          //  VERIFICA PRIMEIRO SE O ACESSO ESTA PARA "ADMIN"... PARA QUE POSSA CHAMAR A TELA DE CADASTRO PARA USUÁRIO DO SISTEMA //
          if($objApelido == "ADMIN")
          {// APONTA PARA A PÁGINA DE CADASTRO DE NOVO USUÁRIO //
                mysql_query("UPDATE login SET logDataIn = '$data', logTimeIn = '$hora', logLogin = 1 WHERE logCodigo = '$objCodigo'");
               
               // INSERE NA TABELA PONTEIRO O USUÁRIO E O ENDEREÇO PARA A PRÓXIMA PÁGINA  //
                mysql_query("UPDATE ponteiro SET ponPonteiro = 1, ponData = '$data', ponHora = '$hora', ponResponsavel = '$objUsuario' WHERE ponResponsavel LIKE '$objUsuario'");
          }

          else // SENÃO SEGUE O PROCEDIMENTO NORMAL //
          {
               // VERIFICA SE OS VALORES DIGITADOS NO CAMPO SÃO IGUAIS AOS VALORES QUE CONSTAM NO BANCO E RETORNA //
                if($nome == $objUsuario && $senha == $objSenha)
                {


                    /*##############################################################################################################################*/
                              // ESTE TRECHO É O COMEÇO DA IA PARA O REGISTRO DE UM PEDIDO DE CADA VENDEDOR SIMULTANEAMENTE //
                    /*##############################################################################################################################*/
                    mysql_query("CREATE TABLE IF NOT EXISTS $objUsuario (Codigo INT(5) NOT NULL, Cliente_fk INT(5) NOT NULL, Codigo_fk CHAR(20) NOT NULL, coringa CHAR(20) NOT NULL, Hora CHAR(8)NOT NULL, Data CHAR(10) NOT NULL, Responsavel CHAR(20) NOT NULL, Valor DOUBLE(8,2) NOT NULL, Desconto DOUBLE(8,2) NOT NULL, Pedido_fk INT(5) NOT NULL, Orcamento_fk INT(5) NOT NULL, Km CHAR(20) NOT NULL, Garantia CHAR(20) NOT NULL, Comentario VARCHAR(100) NOT NULL, Dia CHAR(2) NOT NULL, Mes CHAR(2) NOT NULL, Ano CHAR(4) NOT NULL, reg_date TIMESTAMP)");
                                        /* FINAL DE CRIAÇÃO DE TABELA */
                    // ### INSERINDO O PRIMEIRO REGISTRO NA TABELA TEMPORÁRIA ### //
                    mysql_query("INSERT INTO $objUsuario (pedHora,pedData,pedResponsavel) VALUES ('$hora','$data','$objUsuario')");



                    // INSERE O LOGIN NA TABELA MEMO  //
                    mysql_query("INSERT INTO login_memo (logMemoData, logMemoHora, logMemoUsuario) VALUES ('$data', '$hora', '$objUsuario')");

                    //  ## ATUALIZA A TABELA DE LOGIN ## //
                    mysql_query("UPDATE login SET logDataIn = '$data', logTimeIn = '$hora', logLogin = 1 WHERE logCodigo = '$objCodigo'");

                    // ## ATUALIZA A TABELA DE PONTEIRO ## //
                    mysql_query("UPDATE ponteiro SET ponPonteiro = 1, ponData = '$data', ponHora = '$hora' WHERE ponResponsavel LIKE '$objUsuario'");
                   
                    // ## CRIA A SESSÃO PARA O PROXIMO ARQUIVO ## //
                    $_SESSION['usuario'] = $objUsuario;
                    

                    // VERIFICA O ULTIMO PEDIDO DA TABELA //
                    $_sql = mysql_query("SELECT pedCodigo, pedCliente_fk FROM pedidos");
                    while($_obj = mysql_fetch_array($_sql))
                    {
                         $_pedido  = $_obj['pedCodigo'];
                         $_cliente = $_obj['pedCliente_fk'];
                    }

                    // ATUALIZA A TABELA DE CONTAINER_PEDIDO //
                    mysql_query("UPDATE container_pedido SET conStatus = 0, conCodigoCliente = '$_cliente', conCodigoPedido_fk = '$_pedido', data = '$data' WHERE conResponsavel LIKE '$objNome'");
                    print 1;  // RETORNA 1 É PORQUE ESTÁ VÁLIDO O LOG //
                } 

                else
                {
                    print 0;  //RETORNA ZERO É PORQUE ESTÁ INCORRETO //
                }
          }
?>