<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    
 ####   ARQUIVO PARA EXCLUIR ITEM DE ORÇAMENTO  ###  */
     require 'Utilidades/conexao.php';
    
    $codigoOrcamento = $_REQUEST['codigoGrid'];
    $codigoCliente   = $_REQUEST['codigoCliente'];
    $idProduto       = $_REQUEST['orcItensIdProduto_fk'];

    mysql_query("DELETE FROM orcamento_itens WHERE orcItensIdProduto_fk = '$idProduto' AND orcItens_fk = '$codigoOrcamento'");
    $vl = mysql_query("SELECT SUM(orcItensTotal) AS VALOR from orcamento_itens WHERE orcItens_fk = '$codigoOrcamento'");
     while($objVl = mysql_fetch_array($vl))
     {
          $valorOrcamentoNovo = $objVl['VALOR'];
     }

     mysql_query("UPDATE orcamento SET orcTotal = '$valorOrcamentoNovo' WHERE orcCodigo = '$codigoOrcamento'");
     mysql_query("UPDATE container SET conStatus = 0, conCodigoCliente = '$codigoCliente'");

    header('Location:index.php');

?>