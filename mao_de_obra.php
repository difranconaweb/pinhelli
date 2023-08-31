<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS PARA INSERIR A MÃO DE OBRA  */
    require 'Utilidades/conexao.php';

    $data         = Date('d/m/Y');                    // CRIA A DATA DO SERVER //
    $dia          = Date('d');                        // CRIA O DIA //
    $mes          = Date('m');                        // CRIA O MÊS //
    $ano          = Date('Y');                        // CRIA O ANO //
    $obra         = strtoupper(trim($_GET['obra']));  // DESCRIÇÃO DA MÃO DE OBRA //
    $m_obra       = $_GET['m_obra'];                  // VALOR DA MÃO DE OBRA //
    $pedido       = $_GET['pedido'];                  // NÚMERO DO PEDIDO   //
    $valor        = $_GET['valor'];                   // VALOR DO PEDIDO QUE SERÁ SOMANDO COM A MAO DE OBRA //
    $usuario      = $_GET['usuario'];                 // ´VARIÁVEL RECEBE O USUÁRIO //
    $id_cliente   = $_GET['id_cliente'];              // ´VARIÁVEL RECEBE O ID DO CLIENTE //

    $sql = mysql_query("SELECT pedValor FROM pedidos WHERE pedCodigo = '$pedido'");
    while($obj = mysql_fetch_array($sql))
    {
         $value = $obj['pedValor'];
    }

    $value = ($value+$m_obra); // SOMA OS VALORES //


    // ATUALIZA A TABELA DE PEDIDOS //
    mysql_query("UPDATE pedidos  SET pedValor = '$value' WHERE pedCodigo = '$pedido'");  

    // ATUALIZA A TABELA DE ITENS DO PEDIDO  //
   $iten = mysql_query("INSERT INTO pedido_itens (pedIteItem_fk,pedIteQuantidade,pedIteDescricao,peditePreco,pedIteTotal,pedIteResponsavel,pedIteData,pedItePedido_fk,pedIteCliente_fk,pedIteIdProduto_fk,pediteDia,pedIteMes,pedIteAno) VALUES (0, 1, '$obra','$m_obra','$m_obra','$usuario','$data','$pedido','$id_cliente',0,'$dia','$mes','$ano')");

    if(empty($iten))
    {
        print 0;
    }

    else
    {
        print 1;
    }
?>