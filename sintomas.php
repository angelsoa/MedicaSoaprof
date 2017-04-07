<?php

function string2url($cadena) {
	$cadena = trim($cadena);
	//$cadena = strtr($cadena,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",                       "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	//$cadena=preg_replace("/[\"\'\]/", " ",$cadena);
  $cadena = str_replace("%26","&",$cadena );
	//$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
	$cadena = preg_replace('#([^¿?üÁÉÍÓÚáéíóú\¡!ñÑ°·«»§®$",.a-z0-9]+)#i', ' ', $cadena);
         $cadena = preg_replace('#-{2,}#','-',$cadena);
         $cadena = preg_replace('#-$#','',$cadena);
         $cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}
//$text=$_POST['valor'];





if(isset($_POST['texto'])){
   
  $text=$_POST['texto'];
  $texto=urldecode(string2url($text));
  $textEncode= urlencode($texto);
  $url='http://201.103.153.119:8393/api/v10/analysis/text?collection=CIE10_03_Sintomas&text='.$textEncode.'&output=application/json';
  $rCURL = curl_init();
  curl_setopt($rCURL, CURLOPT_URL, $url);
  curl_setopt($rCURL, CURLOPT_HEADER, 0);
  curl_setopt($rCURL, CURLOPT_RETURNTRANSFER, 1);
  $aData = curl_exec($rCURL);
  $result = json_decode($aData,true);
  curl_close($rCURL);
  // $print=$result['uri'];
  // var_dump($print);
  // echo "<br>".$print;


 if(isset($result['metadata']['textfacets'])){

    $arrayD00=[];
    $i=0;
    for($k = 0; $k < count($result['metadata']['textfacets']); $k++) {
      $path=$result['metadata']['textfacets'][$k]['path'][0];
      $searchCode=preg_match("/cie10_sintomas/",$path);
      //echo $searchCode.'<br>';
      if($searchCode===1){
        $codigos=$result['metadata']['textfacets'][$k]['keyword'];
        $beginCode=$result['metadata']['textfacets'][$k]['begin'];
        $arrayD00[$i]=array($codigos,$beginCode);
        $i++;
      }
    }


// echo "<pre>";
// print_r($arrayD00);
// echo "</pre>";

$arrayResultados=[];  

    for($c = 0; $c < count($arrayD00); $c++) {
      $beginCode=$arrayD00[$c][1];
      $i=0;
        for($k = 0; $k < count($result['metadata']['textfacets']); $k++) {                
          $path=$result['metadata']['textfacets'][$k]['path'][0];
          $searchDiag=preg_match("/descripcion_sintomas/",$path);
          $diagnosticos=$result['metadata']['textfacets'][$k]['keyword'];
          $beginDiag=$result['metadata']['textfacets'][$k]['begin'];
          if($searchDiag===1 & $beginCode===$beginDiag){                   
            $arrayD00[$c][2]=$diagnosticos;
            $arrayD00[$c][3]=$beginDiag;
            $arrayResultados[$c][0]=$diagnosticos;
          break; 

          }
        }
    }


// echo "<pre>";
// print_r($arrayResultados);
// echo "</pre>";


// echo '<table class="table table-striped" style="background-color: white; margin:0px; padding:0px;"> ';
if( count( $arrayResultados ) === 0 ){
     echo ""; //empty arrayResultados
}


else{
  for($l = 0; $l <count($arrayResultados); $l++) {                    
    //echo '<tr id="trTablaSuperior">';
    // for($m = 0; $m <count($arrayResultados[$l]); $m++) {
      
        echo "*".$arrayResultados[$l][0];
     
    //    else{
    //      echo "<tr><td id='tdDiagnosticos' style='border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;'><a id='linkDiagnosticos'>".$arrayResultados[$l][$m].'</a></td></tr>';
    //    }
    // //}
  }


}//else

// echo "</table>";


}//isset $pathTextFacets textoD00
}//isset textoProc

else 
{
  echo "empty";
}

?>  
                  