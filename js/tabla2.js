$( document ).ready(function() {

 function limpiarTexto(cadena){
    cadena=cadena.trim();
    // Definimos los caracteres que queremos eliminar
    var specialChars = "€_~<>°·«»§®ü¡^!@#$^%*()+=-[]\/{}|:<>¿?";
    // Los eliminamos todos
    for (var i = 0; i < specialChars.length; i++) {
        cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), ' ');
    }
    cadena=cadena.replace(/&/gi," ");
    cadena=cadena.replace(/"/gi," ");
    cadena=cadena.replace(/'/gi," ");
        return cadena;
 };


 $("#codificar").click(function() {
    $("#Searching_Modal").modal('show');

    var xmlhttpCodeDiag;
    function ajaxCodeDiag(callback){
        if(window.XMLHttpRequest){
            xmlhttpCodeDiag=new XMLHttpRequest();   
        }
        else{
            xmlhttpCodeDiag=new ActiveXObject("Microsoft.XMLHTTP");
        }
        var textoValue=document.getElementById('datos').value;
        var textoLimpio = decodeURI(limpiarTexto(textoValue));
        var texto="texto="+textoLimpio;
        xmlhttpCodeDiag.open("POST",'code_diag.php',true);
        xmlhttpCodeDiag.timeout = 90000000000000000;
        xmlhttpCodeDiag.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttpCodeDiag.onreadystatechange=function(){
            if(xmlhttpCodeDiag.readyState==4){
                if(xmlhttpCodeDiag.status==200){
                    if( typeof callback === 'function' ){
                        var responseCodeDiag=xmlhttpCodeDiag.responseText;
                        var statusCodeDiag= xmlhttpCodeDiag.statusText;
                        var codeDiagTrim=responseCodeDiag.trim();
                        var codeDiagSubstr = codeDiagTrim.substr(1);
                        var codeDiag = codeDiagSubstr.split("*");
                        callback(codeDiag);
                    }        
                }
                else{
                alert("Ha ocurrido un error "+ statusCodeDiag);
                }
            }
        };
        xmlhttpCodeDiag.send(texto);
    };

    var xmlhttp;
    function ajaxDiag(callback){
        if(window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();   
        }
        else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        var textoValue=document.getElementById('datos').value;
        var textoLimpio = decodeURI(limpiarTexto(textoValue));
        var texto="texto="+textoLimpio;
        xmlhttp.open("POST",'diag_general.php',true);
        xmlhttp.timeout = 90000000000000000;
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4){
                if(xmlhttp.status==200){
                    if( typeof callback === 'function' ){
                        var response=xmlhttp.responseText;
                        var status= xmlhttp.statusText;
                        var diagTrim=response.trim();
                        var diagSubstr = diagTrim.substr(1);
                        var diagnosticos = diagSubstr.split("*");
                        callback(diagnosticos);
                    }        
                }
                else{
                alert("Ha ocurrido un error "+ status);
                }
            }
        };
        xmlhttp.send(texto);
    };


 var xmlhttpCodeProc;
    function ajaxCodeProc(callback){
        if(window.XMLHttpRequest){
            xmlhttpCodeProc=new XMLHttpRequest();   
        }
        else{
            xmlhttpCodeProc=new ActiveXObject("Microsoft.XMLHTTP");
        }
        var textoValue=document.getElementById('datos').value;
        var textoLimpio = decodeURI(limpiarTexto(textoValue));
        var texto="texto="+textoLimpio;
        xmlhttpCodeProc.open("POST",'code_proc.php',true);
        xmlhttpCodeProc.timeout = 90000000000000000;
        xmlhttpCodeProc.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttpCodeProc.onreadystatechange=function(){
            if(xmlhttpCodeProc.readyState==4){
                if(xmlhttpCodeProc.status==200){
                    if( typeof callback === 'function' ){
                        var responseCodeProc=xmlhttpCodeProc.responseText;
                        var statusCodeProc= xmlhttpCodeProc.statusText;            
                        var codeProcTrim=responseCodeProc.trim();
                        var codeProcSubstr = codeProcTrim.substr(1);
                        var codeProc= codeProcSubstr.split("*");
                        callback(codeProc);
                    }  
                }
                else{
                    alert("Ha ocurrido un error "+ statusCodeProc);
                }
            }
        };
        xmlhttpCodeProc.send(texto);
    };



 var xmlhttpProc;
    function ajaxProc(callback){
        if(window.XMLHttpRequest){
            xmlhttpProc=new XMLHttpRequest();   
        }
        else{
            xmlhttpProc=new ActiveXObject("Microsoft.XMLHTTP");
        }
        var textoValue=document.getElementById('datos').value;
        var textoLimpio = decodeURI(limpiarTexto(textoValue));
        var texto="texto="+textoLimpio;
        xmlhttpProc.open("POST",'proc_inferior.php',true);
        xmlhttpProc.timeout = 90000000000000000;
        xmlhttpProc.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttpProc.onreadystatechange=function(){
            if(xmlhttpProc.readyState==4){
                if(xmlhttpProc.status==200){
                    if( typeof callback === 'function' ){
                        var responseProc=xmlhttpProc.responseText;
                        var statusProc= xmlhttpProc.statusText;
                        var procTrim=responseProc.trim();
                        var procSubstr = procTrim.substr(1);
                        var procedimientos = procSubstr.split("*");
                        callback(procedimientos);

                    }           
                }
                else{
                    alert("Ha ocurrido un error "+ statusProc);
                }
            }
        };
        xmlhttpProc.send(texto);
    };


ajaxCodeDiag(function(codeDiag) {

ajaxDiag(function(diagnosticos) {
    //console.log(diagnosticos);
ajaxCodeProc(function(codeProc) {
 ajaxProc( function(procedimientos) {
      //console.log(procedimientos);
  //ajaxSinto( function(sintomas) {
    //console.log(sintomas);

    var tabla = "<table class='table table-bordered table table-striped' style='background-color: white; table-layout:fixed;'>";
    tabla +="<tr>";
    tabla +="<th class='col-lg-2' style='background-color:#fa5151; color:white;'>Cod. Diag.</th>";
    tabla +="<th class='col-lg-4' style='background-color:#fa5151; color:white;'>Diagnósticos</th>";
    tabla +="<th class='col-lg-2 bg-success'>Cod. Proc.</th>";
    tabla +="<th class='col-lg-4 bg-success'>Procedimientos</th>";
    tabla +="</tr>";


    var arrayMayor=[codeDiag.length,diagnosticos.length,codeProc.length,procedimientos.length];
    //  console.log(diagnosticos.length);
    // console.log(procedimientos.length);
    //  console.log(sintomas.length);

    function mayor(lista){
        var mayor = lista[0];
        for(i=1;i<lista.length;i++){
        if(lista[i] > mayor)
            mayor=lista[i];
        }
        return mayor;
    }; 

    var mayor=mayor(arrayMayor);
    //console.log(mayor);

    for(var j = 0; j<mayor; j++){
      tabla += "<tr>";
        if(codeDiag[j]){
            tabla += "<tr><td>"+codeDiag[j]+"</td>";
        }
        else{
            tabla += "<td></td>";
        }
        if(diagnosticos[j]){
            tabla += "<td>"+diagnosticos[j]+"</td>";
        }
        else{
            tabla += "<td></td>";
        }
         if(codeProc[j]){
             tabla += "<td>"+codeProc[j]+"</td>";
         }
         else{
         tabla += "<td></td>";
         }
         if(procedimientos[j]){
             tabla += "<td>"+procedimientos[j]+"</td></tr>";
         }
         else{
         tabla += "<td></td>";
         }
       tabla += "</tr>";
    }

    tabla += "</table>";
    document.getElementById("resultadosTabla2").innerHTML=tabla;
    $("#Searching_Modal").modal('hide');

  });
  });
  });
  });

 });

}); //document.ready