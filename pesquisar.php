<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 08JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PESQUISA DE PEDIDO  */
     require 'Utilidades/conexao.php';

     $hora = date('H:i:s');
     $data = date('d:m:Y');

     $pesquisar = strtoupper(trim($_GET['pesquisar']));
     $pedido    = $_GET['pedido'];
     $usuario   = $_GET['usuario'];
    
     // ##  PRIMEIRO PEGA O ID DO CLIENTE NA TABELA DE CLIENTES ## //
     // BUSCA O REGISTRO //
             $_sql = mysql_query("SELECT cliCodigo, cliNome, cliVeiculo, cliPlaca FROM clientes WHERE cliPlaca LIKE '$pesquisar' OR cliNome LIKE '$pesquisar%' AND cliExcluir = 0");
             while($_obj = mysql_fetch_array($_sql))
             {
                  $codigo  = $_obj['cliCodigo'];
                  $nome    = $_obj['cliNome'];
                  $veiculo = $_obj['cliVeiculo'];
                  $placa   = $_obj['cliPlaca'];
             }
            // ##  FINAL DE PESQUISA DE PLACA ## //

            // ##  VERIFICA QUANTOS CLIENTES EXISTEM EM CASO DA PESQUISA SER FEITA PELO NOME ## //
            $count = mysql_num_rows($_sql);
            // ##  FINAL DE CONTAGEM DE PESQUISA PELO NOME ## //

     if($count == 0)
     {
       // ## SE VOLTAR VÁZIO, ENTÃO NÃ HÁ CLIENTE REGISTRADO NA TABELA ## //
        print 0;
     }

     else if($count == 1)
     {// ESTE BLOCO NO CASO DE VOLTAR SOMENTE UM REGISTRO NA TABELA //
        // ## ATUALIZA A TABELA DE PEDIDOS PARA STATUS SEMI-FECHADO ## //
        mysql_query("UPDATE pedidos SET pedCliente_fk = '$codigo', pedPedido_fk = 0 WHERE pedCodigo ='$pedido'"); // INSERE O NÚMERO DO CLIENTE NA TABELA JÁ NA PESQUISA  E ALTERA A TABELA PARA SEMI-FECHADO //

         // ##  ATUALIZA A TABELA DE CONTAINER DE PEDIDOS ## //
        mysql_query("UPDATE container_pedido SET conStatus = 3, conCodigoCliente = '$codigo', conCodigoPedido_fk = '$pedido' WHERE conResponsavel LIKE '$usuario'"); // INSERE NA TABELA DE STATUS O NOVO STATUS E O CLIENTE //

        
         // ## INSERE NA TABELA TEMPORARIA O NUMERO DO CLIENTE SELECIONADO ## // 
         mysql_query("UPDATE $usuario SET Cliente_fk = '$codigo', Hora = '$hora', Data = '$data'");

         // ##  ATUALIZA A TABELA DE PONTEIRO COM O ID DO CLIENTE ## //
        mysql_query("UPDATE ponteiro SET  ponPesquisa = '$pesquisar' WHERE ponResponsavel LIKE '$usuario'");
         // ##  FINAL DE ATUALIZAÇÃO DE TABELA DE PONTEIRO ## //
         print 1;
     }

     else
     { 
          $_sql = mysql_query("SELECT cliCodigo, cliNome, cliVeiculo, cliPlaca FROM clientes WHERE cliPlaca LIKE '$pesquisar' OR cliNome LIKE '$pesquisar%' AND cliExcluir = 0");
                     while($_obj = mysql_fetch_array($_sql))
                     {
                          $codig3  = $_obj['cliCodigo'];
                          $nom3    = $_obj['cliNome'];
                          $veicul3 = $_obj['cliVeiculo'];
                          $plac3   = $_obj['cliPlaca'];

                         // ## ROTINA PARA INSERIR OS DADOS DA TABELA NO JSON  ## //
                          $array[] = array(
                         'Codigo'   => $codig3,
                         'Nome'     => $nom3,
                         'Veiculo'  => $veicul3,
                         'Placa'    => $plac3
                         );  
                     }
                    // TERMINO DE ROTINA PARA CRIAR ARQUIVO JSON //
                         
                         // CONVERTE OS DADOS DA TABELA EM JSON //
                         $dados_json = json_encode($array);
                         // CRIA UM ARQUIVO JSON //
                         $fp = fopen("cadastro.json", "a");
                         // ESCREVE O CONTEÚDO JSON DENTRO DO ARQUIVO ABERTO //
                         fwrite($fp, $dados_json);
                         // FECHA O ARQUIVO //
                         fclose($fp);
                    
                      // APAGANDO ARQUIVO JSON PARA NÃO ACUMULAR CARGA //
                       unlink('cadastro.json'); 
                     //  $file = stripcslashes($file); 
                       print $dados_json; //dados_json; // ENVIANDO OS DADOS PARA A FUNÇÃO JS //
                       

         // ## FINAL DE ROTINA DE DEVOLUÇÃO ## //
     }
?>