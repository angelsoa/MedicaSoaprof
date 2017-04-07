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
  //echo $text;
  $texto=urldecode(string2url($text));
  $textEncode= urlencode($texto);
  $url='http://201.103.153.119:8393/api/v10/analysis/text?collection=CIE10_DIAG001&text='.$textEncode.'&output=application/json';
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

$arrayResultados=[];
$arrayResultados2=[];  
 if(isset($result['metadata']['textfacets'])){

    $arrayD00=[];
    $i=0;
    for($k = 0; $k < count($result['metadata']['textfacets']); $k++) {
      $path=$result['metadata']['textfacets'][$k]['path'][0];
      $searchCode=preg_match("/cie10_generales/",$path);
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

    for($c = 0; $c < count($arrayD00); $c++) {
     for($k = 0; $k < count($result['metadata']['textfacets']); $k++) { 
        $codD00=$arrayD00[$c][0];
        $beginCode=$arrayD00[$c][1];
        $path=$result['metadata']['textfacets'][$k]['path'][0];
        $searchDiag=preg_match("/diagnosticos_generales/",$path);
        $diagnosticos=$result['metadata']['textfacets'][$k]['keyword'];
        $beginDiag=$result['metadata']['textfacets'][$k]['begin'];
        if($searchDiag===1 & $beginCode===$beginDiag){             
          $arrayD00[$c][2]=$diagnosticos;
          $arrayD00[$c][3]=$beginDiag;
          $arrayResultados[$c][0]=$diagnosticos;
          $arrayResultados2[$c]=array($codD00,$diagnosticos);
          break; 
        }
       }
    }


// echo "<pre>";
// print_r($arrayD00);
// echo "</pre>";

// echo "<pre>";
// print_r($arrayResultados);
// echo "</pre>";

// echo "<pre>";
// print_r($arrayResultados2);
// echo "</pre>";

 

// else if(isset($_POST['textoD02'])){
   
//   $text1=$_POST['textoD02'];
//   $texto1=urldecode(string2url($text1));
//   $textEncode1= urlencode($texto1);
  $url1='http://201.103.153.119:8393/api/v10/analysis/text?collection=CIE10_DIAG002&text='.$textEncode.'&output=application/json';
  $rCURL1 = curl_init();
  curl_setopt($rCURL1, CURLOPT_URL, $url1);
  curl_setopt($rCURL1, CURLOPT_HEADER, 0);
  curl_setopt($rCURL1, CURLOPT_RETURNTRANSFER, 1);
  $aData1 = curl_exec($rCURL1);
  $result1 = json_decode($aData1,true);
  curl_close($rCURL1);
  // $print=$result['uri'];
  // var_dump($print);
  // echo "<br>".$print;
if(isset($result1['metadata']['textfacets'])){

    $arrayD02=[];
    $i=0;
    for($k = 0; $k < count($result1['metadata']['textfacets']); $k++) {
      $path1=$result1['metadata']['textfacets'][$k]['path'][0];
      $searchCode1=preg_match("/cie10_generales/",$path1);
      //echo $searchCode.'<br>';
      if($searchCode1===1){
        $codigos1=$result1['metadata']['textfacets'][$k]['keyword'];
        $beginCode1=$result1['metadata']['textfacets'][$k]['begin'];
        $arrayD02[$i]=array($codigos1,$beginCode1);  
        $i++;
      }
    }
// echo "<pre>";
// print_r($arrayD02);
// echo "</pre>";

    for($c = 0; $c < count($arrayD02); $c++) {
      for($k = 0; $k < count($result1['metadata']['textfacets']); $k++){
        $codeD02=$arrayD02[$c][0];
        $beginCode1=$arrayD02[$c][1];                
        $path1=$result1['metadata']['textfacets'][$k]['path'][0];
        $searchDiag1=preg_match("/diagnosticos_generales/",$path1);
        $diagnosticos1=$result1['metadata']['textfacets'][$k]['keyword'];
        $beginDiag1=$result1['metadata']['textfacets'][$k]['begin'];
        // echo $searchDiag1."<br>";
        if($searchDiag1===1 & $beginCode1===$beginDiag1){             
          $arrayD02[$c][2]=$diagnosticos1;
          $arrayD02[$c][3]=$beginDiag1;
          $arrayResultados[$c][1]=$diagnosticos1;
          $arrayResultados2[$c][2]=$codeD02;
          $arrayResultados2[$c][3]=$diagnosticos1;  
          break; 
        }
      }
    }   

// echo "<pre>";
// print_r($arrayD02);
// echo "</pre>";

// echo "<pre>";
// print_r($arrayResultados);
// echo "</pre>";

// echo "<pre>";
// print_r($arrayResultados2);
// echo "</pre>";

// echo '<table class="table table-striped" style="background-color: white; margin:0px; padding:0px;"> ';

if( count( $arrayResultados2 ) === 0 ){
  //echo "Diagnosticos vacios"; //empty arrayResultados
  echo "";
}
else{

  for($l = 0; $l<=max(array_keys($arrayResultados2)); $l++) {    
    for($m = 0; $m<=max(array_keys($arrayResultados2[$l])); $m++) {
  // var_dump(isset($arrayResultados2[$l][$m]));
      if($m%2===1 && isset($arrayResultados2[$l][$m]) ){
        // echo "<tr><td id='tdDiagnosticos' style='border-top:1px solid #dddddd;border-bottom:1px solid #dddddd;'><a id='linkDiagnosticos'>".$arrayResultados2[$l][$m]."</a></td></tr>";
         echo "*".$arrayResultados2[$l][$m];
      }

    }
  }

}//else


// echo "</table>";






}//isset $pathTextFacets textoD02
}//isset $pathTextFacets textoD00
}//isset textoD00

else 
{
  echo "empty textDiag";
}

?>  
                  