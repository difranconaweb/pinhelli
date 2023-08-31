<html>


<?php

 // require_once '../fotos/perfil/teste.php';

  $vl = trim(strtolower('KIKO'));
  $senha = sha1($vl);
  
  //mkdir($pasta,0744);
  
?>
<head>
<script src="sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">

<script>
//  ESTA ROTINA SERVER PARA CORRIGIR A DATA CASO VENHA DO CELULAR //
/*function acionar()
{
	var data_nasc = document.getElementById('data_nasc').value;
	var obj = data_nasc.indexOf('-');    // VERIFICA SE A DATA PASSADA CONTÉM ESTE SINAL //

    if(obj == -1)
    {
       data_nasc = data_nasc;
    }

    else
    {
       var  d = data_nasc.substr(8,2);
       var  m = data_nasc.substr(5,2);
       var  y = data_nasc.substr(0,4);
       data_nasc = d+'/'+m+'/'+y;
       alert(data_nasc);
    }
} */
import Swal from 'sweetalert2/dist/sweetalert2.js'

import 'sweetalert2/src/sweetalert2.scss'

Swal.fire('Hello world!');
document.getElementById('exec').onclick = function(){
    alert("Olá mundo!");
};  


</script>




</head>

<body>


   <input type="date" name="data_nasc" id="data_nasc" size="15" maxlength="15"> <br/><br/>
   <button name="exec" id="exec">EXECUTAR</script>


</body>
</html>


    

