<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

  
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645  */


// ### INICIO DE ARQUIVO DE CONEXÃO COM BANCO DE DADOS ###  //
      $conexao = mysql_connect("mysql.difranconaweb.com.br","difranconaweb03","polares1");
      $conecta_banco = mysql_select_db("difranconaweb03", $conexao); 
     /*$conecta = mysqli_connect("mysql.elitesporte.com.br", "elitesporte", "polares1", "elitesporte");
     //127.0.0.1", "root","","elitesporte*/
 
	if (!$conecta_banco) 
	{
	    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	} 
?>