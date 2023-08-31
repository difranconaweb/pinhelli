<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 24MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 29MAI23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 07JUN23 - RES000101/13BR
     
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA REGISTRO DE MERCADORIAS */
     require 'Utilidades/conexao.php';
     
       $data = Date('d/m/Y');
 

        $codigo     = strtoupper(trim($_GET['codigo']));
        $marca      = strtoupper(trim($_GET['marca']));
        $descricao  = strtoupper(trim($_GET['descricao']));
        $quantidade = trim($_GET['quantidade']);
        $grupo      = $_GET['grupo'];
        $compra     = trim($_GET['compra']);
        $frete      = trim($_GET['frete']);
        $encargos   = trim($_GET['encargos']);
        $lucro      = trim($_GET['lucro']);
        $compraUni  = trim($_GET['compraUni']);
        $vendaUni   = trim($_GET['vendaUni']);
        $precoTotal = trim($_GET['precoTotal']);
        $lucroFinal = trim($_GET['lucroFinal']);
        $usuario    = strtoupper($_GET['usuario']);
        $excluir    = 0;
  
        

        if(empty($grupo))
        {
            $sq = mysql_query("SELECT gruCodigo  FROM grupo");
            while($obj = mysql_fetch_array($sq))
             {
                 $grupo = $obj['gruCodigo'];   // VERIFICA QUAL FOI O CÓDIGO CRIADO E INSERE NA TABELA DE MERCADORIAS
             }
        }

        else
        {
            $grupo = $grupo;  // SENÃO A VARIÁVEL RECEBE ELA MESMA //
        }
        
        
        //   VERIFICA SE O REGISTRO JÁ CONSTA NA TABELA  -  INDAIATUBA 27OUT19  //
             $sql   = mysql_query("SELECT merCodigoProduto FROM mercadorias WHERE merCodigoProduto LIKE '$codigo'");
             while($obj = mysql_fetch_array($sql))
             {
                  $codigoPeca = $obj['merCodigoProduto'];
             }


             if($codigo == $codigoPeca)
             {
                  print 2;
             }

             else
             {  
                    $sql = mysql_query("INSERT INTO mercadorias (merCodigoProduto,merMarca, merMercadoria,merQuantidade,merCompra,merFrete,merEncargos,merPercentual,merVenda,merPrecoVendaUnid,merPrecoCompraUnid,merLucroFinal,merData,merUltimaAlteracao,merExcluir,merGrupo,merResponsavel) VALUES ('$codigo','$marca','$descricao','$quantidade','$compra','$frete','$encargos','$lucro','$precoTotal','$vendaUni','$compraUni','$lucroFinal','$data','$data','$excluir','$grupo','$usuario')");

                     if(empty($sql))
                     { 
                        print 0;
                     }

                     else
                     {
                        
                        print 1;
                     } 
             }    
?>     