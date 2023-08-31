<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 06JUN23
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 07JUN23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA EDITAR REGISTRO DE MERCADORIAS */

require 'Utilidades/conexao.php';

       $data = Date('d/m/Y');
 
        
        $id         = $_GET['id'];
        $codigo     = strtoupper(trim($_GET['codigo']));
        $marca      = strtoupper(trim($_GET['marca']));
        $descricao  = strtoupper(trim($_GET['descricao']));
        $quantidade = trim($_GET['quantidade']);
        $grupo      = $_GET['grupo'];
        $compra     = trim($_GET['compra']);
        $frete      = trim($_GET['frete']);
        $encargos   = trim($_GET['encargos']);
        $lucro      = trim($_GET['lucro']);
        $vendaUni   = strtoupper(trim($_GET['vendaUni']));
        $compraUni  = strtoupper(trim($_GET['compraUni']));
        $precoTotal = strtoupper(trim($_GET['precoTotal']));
        $lucroFinal = strtoupper(trim($_GET['lucroFinal']));
        $usuario    = strtoupper($_GET['usuario']);
        $excluir    = 0;

        // ### BUSCA NA TABELA O ID DO GRUPO, VISTO QUE ESTÁ CARREGANDO O NOME DO GRUPO NA VARIÁVEL GRUPO ### //
        $_sql = mysql_query("SELECT gruCodigo FROM grupo WHERE gruNome = '$grupo'");
        while($obj = mysql_fetch_array($_sql))
        {
            $objCodigo = $obj['gruCodigo'];
        }


           // ### ALTERANDO O REGISTRO NA TABELA ### //
           $sql = mysql_query("UPDATE mercadorias SET merCodigoProduto = '$codigo', merMarca = '$marca', merMercadoria = '$descricao', merQuantidade = '$quantidade', merCompra = '$compra', merFrete = '$frete', merEncargos = '$encargos', merPercentual = '$lucro', merVenda = '$precoTotal', merPrecoVendaUnid = '$vendaUni', merPrecoCompraUnid = '$compraUni', merLucroFinal = '$lucroFinal', merUltimaAlteracao = '$data', merExcluir = '$excluir', merGrupo = '$objCodigo', merResponsavel = '$usuario' WHERE merCodigo = '$id'");
 
            if(empty($sql))
             {
                print 0;
             }

             else
             {
                print 1;
             } 
?>