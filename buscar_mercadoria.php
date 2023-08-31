<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE PEDIDOS PARA BUSCAR ITEM DE MERCADORIA DE PEDIDO  */
     require 'Utilidades/conexao.php';


     $mercadoria = $_GET['mercadoria'];

     $sql = mysql_query("SELECT merCodigo, merCodigoProduto, merPrecoVendaUnid, merMarca FROM mercadorias WHERE merMercadoria = '$mercadoria'");

     while($obj = mysql_fetch_array($sql))
     {
         $codigo  = $obj['merCodigoProduto'];
     	 $unidade = $obj['merPrecoVendaUnid'];
     	 $marca   = $obj['merMarca'];
     }
     
     $itens = array();
      
         $itens[0]['codigo']      = $codigo; 
         $itens[0]['unidade']     = $unidade;
         $itens[0]['marca']       = $marca;
         

         $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>';
      
         $xml .= '<links>';
           
         for ( $i = 0; $i < count( $itens); $i++ ) 
         {
             $xml .= '<valor>';
                  $xml .= '<codigo>'   . $itens[$i]['codigo']  . '</codigo>';
                  $xml .= '<unidade>'  . $itens[$i]['unidade'] . '</unidade>';
                  $xml .= '<marca>'    . $itens[$i]['marca']   . '</marca>';
             $xml .= '</valor>';
         }

         $xml .= '</links>';

         $fp = fopen('valores.xml', 'w+');
         fwrite($fp, $xml);
         fclose($fp); 

         $obj = simplexml_load_file("valores.xml") or die ("ERRO!");


         print $obj->valor[0]->codigo."!"."</br>";
         print $obj->valor[0]->unidade."#"."</br>";
         print $obj->valor[0]->marca."$"."</br>";
?>