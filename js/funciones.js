$( document ).ready(function() {
 
 $("#modalLogin").click(function() {
      window.location.reload();
 });




 $("#btnLimpiar").click(function() {
      $("#text").val("");
 });

 $("#ingresar").click(function() {
    var username=$("#username").val();
    var password=$("#password").val();
    console.log(username,password);
    if (username==="Chema" && password==="Chema123" ||
        username==="Juan_Carlos" && password==="Juan123" ||
        username==="Sarai" && password==="Sarai123" ||
        username==="Ses" && password==="Ses123" ||
        username==="etienne" && password==="ibm123" ||
        username==="crivas" && password==="Carlos123" ||
        username==="Doncel" && password==="Doncel123" ||
        username==="asepeyo" && password==="Asepeyo123" ||
        username==="consejeria_sanidad" && password==="Sanidad123") 
    {
        $("#Searching_Modal").modal('show');
        setTimeout(function(){
            $("#Searching_Modal").modal('hide');
            window.location="inicio.php";
        }, 1000);
    }
    else{
        //alert("¡Usuario o Contraseña no válida!");
         $("#modalLogin").modal('show');
         
        //window.location.reload();
    }
 });    
}); //document.ready