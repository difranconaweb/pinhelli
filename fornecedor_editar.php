<?php
/*   SISTEMA DESENVOLVIDO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SISTEMA DESARROLLADO POR FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23
     SYSTEM  DEVELOPED    BY  FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23

     
     ÚLTIMA ALTERAÇÃO FRANCO VIEIRA MORALES - INDAIATUBA 19MAI23 - RES000101/13BR
                                                                   (19)3017-3460
                                                                   (19)99272-0159
                                                                   (19)99751-7645

     ARQUIVO PARA EDITAR REGISTRO DE FORNECEDOR */                                                                   
     require 'Utilidades/conexao.php';

       $data = Date('d/m/Y');
 
        $codigo     = $_GET['codigo'];
        $razao      = strtoupper(trim($_GET['razao']));
        $fantasia   = strtoupper(trim($_GET['fantasia']));
        $cep        = strtoupper(trim($_GET['cep']));
        $endereco   = strtoupper(trim($_GET['endereco']));
        $numero     = strtoupper(trim($_GET['numero']));
        $cidade     = strtoupper(trim($_GET['cidade']));
        $telefone   = trim($_GET['telefone']);
        $celular    = trim($_GET['celular']);
        $cnpj       = trim($_GET['cnpj']);
        $inscricao  = trim($_GET['inscricao']);
        $contato    = strtoupper(trim($_GET['contato']));
        $email      = strtolower(trim($_GET['email']));
        
        

            $sql = mysql_query("UPDATE fornecedores SET forRazao = '$razao', forFantasia = '$fantasia', forCep = '$cep', forEndereco = '$endereco', forNumero = '$numero', forCidade = '$cidade', forCNPJ = '$cnpj', forInscricao = '$inscricao', forTelefone = '$telefone', forCelular = '$celular', forResponsavel = '$contato', forEmail = '$email', forData = '$data' WHERE forCodigo = '$codigo'");

             if(empty($sql))
             {
                print 0;
             }

             else
             {
                print 1;
             } 
?>     