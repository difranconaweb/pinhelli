<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

    
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PESQUISA DE GRUPO  */
     require 'Utilidades/conexao.php';

 // ### ESTAS VARIÁVEIS VEM MAS NÃO ESTÃO SENDO UTILIZADAS ### //
     $pesquisar  = strtoupper(trim($_GET['pesquisar']));
     $mercadoria =  $_GET['mercadoria']; // ESTA VARIÁVEL CONTÉM O ID DA MERCADORIA //
     $usuario    =  $_GET['usuario']; // ESTA VARIÁVEL CONTÉM O NOME DE QUEM ESTÁ USANDO O SISTEMA //
    
     // ##  BUSCA O GRUPO SELECIONADO NO FRONT END ## //
     // BUSCA O REGISTRO //
         $_sql = mysql_query("SELECT gruCodigo, gruNome FROM grupo");
         while($_obj = mysql_fetch_array($_sql))
         {
              $codigo  = $_obj['gruCodigo'];
              $nome    = $_obj['gruNome'];


              // ## ROTINA PARA INSERIR OS DADOS DA TABELA NO ARQUIVO JSON  ## //
                  $array[] = array(
                 'Codigo'   => $codigo,
                 'Nome'     => $nome,
                 );  
         }
        // ##  FINAL DE BUSCAR GRUPO ## //


        // ## MENSAGEM DE EXCESSÃO SE NÃO DER RETORNO NA QUERY //
        if(empty($_sql))
        {
            print 0;
        }
        // ## SENÃO DEVOLVE O ARQUIVO JSON CARREGADOS ## //
        else
        {
        // TERMINO DE ROTINA PARA CRIAR ARQUIVO JSON //
             
             // CONVERTE OS DADOS DA TABELA EM JSON //
             $dados_json = json_encode($array);
             // CRIA UM ARQUIVO JSON //
             $fp = fopen("grupo.json", "a");
             // ESCREVE O CONTEÚDO JSON DENTRO DO ARQUIVO ABERTO //
             fwrite($fp, $dados_json);
             // FECHA O ARQUIVO //
             fclose($fp);
        // TERMINO DE ROTINA PARA CRIAR ARQUIVO XML //

          // APAGANDO ARQUIVO JSON PARA NÃO ACUMULAR CARGA //
           unlink('grupo.json'); 
         //  $file = stripcslashes($file); 
           print $dados_json; //dados_json; // ENVIANDO OS DADOS PARA A FUNÇÃO JS //
                       
         // ## FINAL DE ROTINA DE DEVOLUÇÃO ## //
        }
             
     
?>