<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


    ROTINA DE FILTRO DE PEDIDO  */
    require 'Utilidades/conexao.php';

    $grupo  = $_GET['grupo'];
   
    $sql = mysql_query("SELECT 'SELECIONE' FROM mercadorias  UNION SELECT merMercadoria AS 'SELECIONE' FROM mercadorias WHERE merGrupo = '$grupo' AND merExcluir = 0");
   
    $numMercadorias = mysql_num_rows($sql);


for($j=0;$j<$numMercadorias;$j++){
	$dados = mysql_fetch_array($sql);
	$mercadoria = "<option value='".$dados['SELECIONE']."'>".$dados['SELECIONE'] ."</option>";
    print utf8_encode($mercadoria);
}

?>