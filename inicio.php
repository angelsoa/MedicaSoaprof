<!DOCTYPE html>
 <html >
  <head>
   <title>CIE 10</title>
   <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>﻿
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap -->  
   <link rel="stylesheet" href="css/bootstrap/bootstrap.css" type="text/css"/>
   <link rel="stylesheet" href="css/jasny-bootstrap/jasny-bootstrap.min.css" type="text/css"/>
   <link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.css" type="text/css"/>
   <link rel="stylesheet" href="css/bootstrap-table-master/bootstrap-table.min.css" type="text/css"/>
   <link rel="stylesheet" href="css/bootstrap-dialg/bootstrap-dialog.css" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="css/estilos.css">  
   <!-- Librerias -->
   <script src="js/jquery/jquery-1.12.0.min.js"></script>
   <!-- <script src="js/angular/angular.min.js"></script> -->
   <style type="text/css">
    .trans {background-color: rgba(255, 255, 255, 0.5);
      border-radius: 12px;/*padding-buttom-b: 0px;*//*margin-top: 10px;*/}
   
    </style>

    <link href="https://fonts.googleapis.com/css?family=Days+One" rel="stylesheet">
    <script type="text/javascript">




    </script>
  </head>   
  <body >
  
   <div class=container style="margin-top: -20px;">
    <div class="panel-body" >    
     <!--<div class="col-lg-1 col-md-3 col-sm-3 col-xs-1"></div>-->
      <!--<label style="color:white; font-size:4em;font-family: Days One;" classx="col-lg-7 col-md-7 col-sm-7 col-xs-7">Codificador CIE10</label>-->
      <img src="images/logo13.png" style="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 img-responsive img-rounded "/>
    </div> 
   </div>


   <div class="container-fluid">
    <div class="panel panel-primary trans"> 
     <div class="panel-body">   
      <div class="panel_destinatario"> 
       <div class="panel-primary">
        <div class="panel-heading">Ingresa el texto</div>
         <div class="panel-body">         
          <div class="row">    
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group col-lg-5  col-md-5 col-sm-12 col-xs-12">
             
              <form method="POST">
                <label for="text">Texto</label>
                <textarea class="form-control" id="datos" name="datos" rows="11"></textarea>
                <button style="margin: 1em 0 1em 0;" class="btn btn-danger" id="btnLimpiar">Limpiar</button>
                <input type="button" id="codificar" class="btn btn-success" value="Codificar"/>
              </form>
             
            </div>
            <div class="table-responsive col-lg-7 col-md-7 col-sm-12 col-xs-12" id="area_tabla" style="height: 50vh; overflow-y: scroll;">
              <div id="resultadosTabla1"></div>
            </div>    
           </div><!--col-lg-12-->
            
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" style="height: 50vh; overflow-y: scroll;">   
              <div id="resultadosTabla2"></div>          
           </div>



          </div> <!--row--> 
         </div>  
        </div>
       </div>
      </div> 
     </div>
   </div>       
  <!--Modal Cargando-->
  <div class="container">
   <div class="modal fade" id="Searching_Modal"  role="dialog" tabindex="24" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document" >
       
       <div class="modal-body" style="top:13em;">             
        <center>
          <img class="img-responsive"  src="images/watson.gif">
        </center>                             
       </div> 

    </div>
   </div>
  </div>

  <!--Modal Iniciar sesión-->
  <div class="modal fade" id="modalLogin" tabindex="23" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><img  src="Images/logo13.png">
            <h4 class="modal-title"><b>Enviar cotización por Email</b></h4></center>
        </div>
        <div class="modal-body">
        ¡Usuario o contraseña incorrecta!
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-primary" data-dismiss="modal" id="BtnCotizacionAceptar">Enviar</button>
          </center>
        </div>
      </div>
    </div>
  </div>      
  <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jasny-bootstrap/jasny-bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-multiselect/bootstrap-multiselect.js"></script>
  <script type="text/javascript" src="js/bootstrap-table/bootstrap-table.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-dialog/bootstrap-dialog.js"></script>
  <script type="text/javascript" src="js/bootstrap-select/bootstrap-select.js"></script>
  <script type="text/javascript" src="js/funciones.js"> </script>
  <script type="text/javascript" src="js/tabla1.js"> </script>
  <script type="text/javascript" src="js/tabla2.js"> </script>
  
  </body>
  </html>