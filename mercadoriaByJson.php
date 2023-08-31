<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     

     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PESQUISA DE MERCADORIA VIA JSON  */
     require 'Utilidades/conexao.php';

     $grupo = strtoupper(trim($_GET['grupo']));
    
     // ##  VEM COM O NOME DO GRUPO PARA FAZER A PESQUISA ## //
     // BUSCA TODOS OS  REGISTROS DAQUELE GRUPO //
             $_sql = mysql_query("SELECT merCodigo, merMarca, merMercadoria, merPrecoVendaUnid, gruCodigo FROM `mercadorias` RIGHT JOIN grupo ON mercadorias.merGrupo = grupo.gruCodigo WHERE gruNome = '$grupo' AND merExcluir = 0");
             while($_obj = mysql_fetch_array($_sql))
             {
                  $codigo     = $_obj['merCodigo'];
                  $marca      = $_obj['merMarca'];
                  $mercadoria = $_obj['merMercadoria'];
                  $preco      = $_obj['merPrecoVendaUnid'];
             
            // ##  FINAL DE PESQUISA DE MERCADORIAS POR GRUPO ## //

           
    
                         // ## ROTINA PARA INSERIR OS DADOS DA TABELA NO JSON  ## //
                          $array[] = array(
                         'Codigo'     => $codigo,
                         'Marca'      => $marca,
                         'Mercadoria' => $mercadoria,
                         'Preco'      => $preco
                         );  
             }        
                    // TERMINO DE ROTINA PARA CRIAR ARQUIVO JSON //
                         
                         // CONVERTE OS DADOS DA TABELA EM JSON //
                         $dados_json = json_encode($array);
                         // CRIA UM ARQUIVO JSON //
                         $fp = fopen("mercadoria.json", "a");
                         // ESCREVE O CONTEÚDO JSON DENTRO DO ARQUIVO ABERTO //
                         fwrite($fp, $dados_json);
                         // FECHA O ARQUIVO //
                         fclose($fp);
                    
                  

                      // APAGANDO ARQUIVO JSON PARA NÃO ACUMULAR CARGA //
                    //   unlink('mercadoria.json'); 
                     //  $file = stripcslashes($file); 
                       print $dados_json; //dados_json; // ENVIANDO OS DADOS PARA A FUNÇÃO JS //
                       

         // ## FINAL DE ROTINA DE PESQUISA MERCADORIA VIA JSON ## //
     
?>