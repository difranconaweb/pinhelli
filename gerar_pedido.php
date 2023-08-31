<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

// ARQUIVO PARA GERAR O PEDIDO OFICIAL PARTINDO DO ORÇAMENTO // */

    require 'Utilidades/conexao.php';

// ### COLHENDO AS DATAS ### //
    $data = Date('d/m/Y');
    $hora = Date('H:i:s');
    $dia  = Date('d');
    $mes  = Date('m');
    $ano  = Date('Y');

  
// ### PEGANDO AS INFORMAÇÕES QUE VEM DO FRONT END ###  //
    $orcamento = $_GET['orcamento'];
    $cliente   = $_GET['id_cliente'];
    $usuario   = $_GET['usuario'];


// ##  BUSCANDO O VALOR TOTAL DO PEDIDO ## //
    $sql = mysql_query("SELECT * FROM orcamento WHERE orcCodigo = '$orcamento'");
    while($obj = mysql_fetch_array($sql))
    {
        $total = $obj['orcTotal'];
    }


    // ################################################################################################ //
    // ### PRIMEIRO FAZ UMA BUSCA DE TODOS OS ITENS DO ORÇAMENTO E VERIFICA SE HÁ ALGUM SEM ESTOQUE ### //
    // ###        SE HOUVER ALGUM SEM ESTOQUE DEVOLVE MENSAGEM DE EXCEÇÃO E ABORTA O PEDIDO         ### //
    // ################################################################################################ //
        $_sql = mysql_query("SELECT orcItensQuantidade, orcItensIdProduto_fk, merQuantidade FROM orcamento_itens RIGHT JOIN mercadorias ON orcamento_itens.orcItensIdProduto_fk = mercadorias.merCodigoProduto WHERE orcItens_fk = '$orcamento'");
        while($_obj = mysql_fetch_array($_obj))
        {
            $meQuantidade       = $_obj['merQuantidade'];
            $orcItensQuantidade = $_obj['orcItensQuantidade'];
             //  ### SE FOR DIFERENTE DE ZERO RETORNA PARA O LAÇO ### //
            if($merQuantidade != 0)
            {
                // ### BUSCANDO QUANTAS LINHAS CONTÉM NA TABELA DE ITEM DO ORÇAMENTO ### //
                  $it     = mysql_query("SELECT orcItensCodigo FROM orcamento_itens WHERE orcItens_fk = '$orcamento'");
                  $linhas = mysql_num_rows($it);
                  print $linhas;

                  if($linhas == 0)
                  {     
                        print 1;
                  }

                  else
                  {
              // ### INSERINDO ORÇAMENTO NA TABELA DE PEDIDO ### //
                      mysql_query("INSERT INTO pedidos (pedCliente_fk, pedHora, pedData, pedResponsavel, pedValor, pedPedido_fk, pedDia, pedMes, pedAno, pedOrcamento_fk) VALUES ('$cliente','$hora','$data','$usuario','$total',1,'$dia','$mes','$ano','$orcamento')");

                       $ped = mysql_query("SELECT pedCodigo FROM pedidos");
                       while($objP = mysql_fetch_array($ped))
                       {
                          $numeroPedido = $objP['pedCodigo'];
                       }

              // ### LAÇO DE REPETIÇÃO PARA CARREGAR A TABELA DE ITENS DO PEDIDO PARTINDO DA TABELA DE ITENS_ORÇAMENTO  ### //
                       for($i = 0; $i < $linhas; $i++)
                        {
                           $sq = mysql_query("SELECT * FROM orcamento_itens WHERE orcItens_fk = '$orcamento'");
                           while($obj = mysql_fetch_array($sq))
                           {
                                $codigo     = $obj['orcItensCodigo'];
                                $quantidade = $obj['orcItensQuantidade'];
                                $mercadoria = $obj['orcItensDescricao'];
                                $preco      = $obj['orcItensPreco'];
                                $itenTotal  = $obj['orcItensTotal'];
                                $idProduto  = $obj['orcItensIdProduto_fk'];
                           }

                              $mer = mysql_query("SELECT merQuantidade FROM mercadorias WHERE merCodigoProduto = '$idProduto'");
                           while($objM = mysql_fetch_array($mer))
                           {// ENCONTRA A QUANTIDADE //
                                 $quant = $objM['merQuantidade'];
                           }
                                // SUBTRAI A QUANTIDADE EM ESTOQUE PELO QUE ESTA PEDINDO //
                            $quant = $quant - $quantidade;

                               
                              
                                mysql_query("INSERT INTO pedido_itens (pedIteItem_fk, pedIteQuantidade, pedIteDescricao, pedItePreco, pedIteTotal, pedIteResponsavel, pedIteData, pedItePedido_fk, pedIteCliente_fk, pedIteIdProduto_fk, pedIteDia, pedIteMes, pedIteAno) VALUES ('$idProduto','$quantidade','$mercadoria','$preco','$itenTotal','$usuario','$data','$numeroPedido','$cliente','$idProduto','$dia','$mes','$ano')"); 

                           
              // ### APÓS REMOVER O ITEM DA TABELA DE MERCADORIA, INSERE NA TABELA DE PEDIDO ### //
                            mysql_query("UPDATE mercadorias SET merQuantidade = '$quant' WHERE merCodigoProduto = '$idProduto'");
              // ### REMOVE O ITEM DA TABELA  DE ORCAMENTO_ITENS  ### //
                            mysql_query("DELETE FROM orcamento_itens WHERE orcItensCodigo = '$codigo'");
                         }
              // ### APAGA O ORCAMENTO DA TABELA DE ORÇAMENTOS ### //
                         mysql_query("DELETE FROM orcamento WHERE orcCodigo = '$orcamento'");
                  } 
            }

            else
            {// ### SE HOUVER ALGUM ITEM QUE RETORNA VALOR ZERO, ABORTA O PEDIDO //
                exit; 
                print 1;
            }
        }
 
  // TERMINADO DE CARREGAR, ENVIA MENSAGEM DE EXCECÃO //
    print 0;
 
// ################################################################################################ //
?>