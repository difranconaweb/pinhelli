<?php

/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645


     ARQUIVO JAVASCRIPT PARA CONTROLE DO CAIXA NO SISTEMA  */


     session_start();
     $usuario = $_SESSION['usuario'];

     require 'Utilidades/conexao.php';

  // ## RECEBENDO DADOS DO FORMULÁRIO  ## //
     $entrada    = strtoupper($_GET['entrada']);
     $vlr_entr   = trim($_GET['vlr_entr']);
     $saida      = strtoupper($_GET['saida']);
     $vlr_saida  = trim($_GET['vlr_saida']);
     
     
 
     $vlr_entr  = str_replace(',','.',$vlr_entr);
     $vlr_saida = str_replace(',', '.',$vlr_saida);
 
     
     
     
  // ## PEGANDO DATA E HORA DO SERVIDOR ## //
     $data = Date('d/m/Y'); // PEGA A DATA DO SERVIDOR //
     $hora = Date('H:i:s'); // PEGA O HORÁRIO DO SERVIDOR //
     

  // ## SALVANDO OS DADOS NA TABELA CAIXA ## //
  if(empty($saida))
  {
      $sql = mysql_query("INSERT INTO caixa (caxDescricao, caxVlrEntrada, caxData, caxHora, caxResponsavel) VALUES ('$entrada','$vlr_entr', '$data','$hora','$usuario')");
  }

  else
  {
      $sql = mysql_query("INSERT INTO caixa (caxDescricao, caxVlrSaida, caxData, caxHora, caxResponsavel) VALUES ('$saida', '$vlr_saida','$data','$hora','$usuario')");
  }
// ## VERIFICA SE ALGO DEU ERRADO E RETORNA AO AJAX JS ## //
     if(empty($sql))
     {
           print 0;
     }
    
     else
     {
           print 1;
     }
?> 