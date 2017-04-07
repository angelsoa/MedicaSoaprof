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
        xmlhttp.open("POST",'diagnosticos.php',true);
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
        xmlhttpProc.open("POST",'procedimientos.php',true);
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

 var xmlhttpSinto;
    function ajaxSinto(callback){
        if(window.XMLHttpRequest){
            xmlhttpSinto=new XMLHttpRequest();   
        }
        else{
            xmlhttpSinto=new ActiveXObject("Microsoft.XMLHTTP");
        }
        var textoValue=document.getElementById('datos').value;
        var textoLimpio = decodeURI(limpiarTexto(textoValue));
        var texto="texto="+textoLimpio;
        xmlhttpSinto.open("POST",'sintomas.php',true);
        xmlhttpSinto.timeout = 90000000000000000;
        xmlhttpSinto.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttpSinto.onreadystatechange=function(){
            if(xmlhttpSinto.readyState==4){
                if(xmlhttpSinto.status==200){
                    if( typeof callback === 'function' ){
                        var responseSinto=xmlhttpSinto.responseText;
                        var statusSinto= xmlhttpSinto.statusText;            
                        var sintoTrim=responseSinto.trim();
                        var sintoSubstr = sintoTrim.substr(1);
                        var sintomas= sintoSubstr.split("*");
                        callback(sintomas);
                    }  
                }
                else{
                    alert("Ha ocurrido un error "+ statusSinto);
                }
            }
        };
        xmlhttpSinto.send(texto);
    };

  ajaxDiag(function(diagnosticos) {
    //console.log(diagnosticos);
  ajaxProc( function(procedimientos) {
      //console.log(procedimientos);
  ajaxSinto( function(sintomas) {
    //console.log(sintomas);

    var tabla = "<table class='table table-bordered table table-striped' style='background-color: white; table-layout:fixed;'>";
    tabla +="<tr>";
    tabla +="<th style='background-color:#fa5151; color:white;'>Diagnósticos</th>";
    tabla +="<th class='bg-success'>Procedimientos</th>";
    tabla +="<th class='bg-info'>Síntomas</th>";
    tabla +="</tr>";


    var arrayMayor=[diagnosticos.length,procedimientos.length,sintomas.length];
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
        if(diagnosticos[j]){
            tabla += "<tr><td>"+diagnosticos[j]+"</td>";
        }
        else{
            tabla += "<td></td>";
        }
        if(procedimientos[j]){
            tabla += "<td>"+procedimientos[j]+"</td>";
        }
        else{
        tabla += "<td></td>";
        }
        if(sintomas[j]){
            tabla += "<td>"+sintomas[j]+"</td></tr>";
        }
        else{
            tabla += "<td></td>";
        }
     tabla += "</tr>";
    }

    tabla += "</table>";
    document.getElementById("resultadosTabla1").innerHTML=tabla;
    //$("#Searching_Modal").modal('hide');

  });
  });
  });

 });

}); //document.ready