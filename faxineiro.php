<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645 */

// ### INICIO DE ARQUIVO FAXINEIRO QUE LIMPA A TABELA TEMPORÁRIA PARA ORÇAMENTO ###  //
require 'Utilidades/conexao.php';
    session_start(); // INICIA A SESSÃO //
    $usuario  = $_SESSION['usuario']; // RECEBE A SESSÃO DA PAGINA DE LOGIN.PHP //
    $data = Date('d/m/Y');  // CARREGA A DATA
    $hora = Date('H:i:s');  // CARREGA A HORA


/* ### BUSCA A TABELA QUE FOI CRIADA TEMPORÁRIAMENTE COM O NOME DO USUARIO NA VARIÁVEL DE SESSÃO ### */
    mysql_query("DROP TABLE $usuario");
    /* ###  ATUALIZANDO A TABELA DE PONTEIRO ### */
    mysql_query("UPDATE ponteiro SET ponPonteiro = 6 WHERE ponResponsavel = '$usuario'");
  
       header('Location:http://www.difranconaweb.com.br/pinhelli/controller.php');
    
?>  