<?php
$n= array(10,20,30,40,50);
$s=20;
$f=false;

foreach ($n as $num) {
    if ($num==$s){
        $f=true;
    }
    else{
        $f=false;
    }
}

if($f){
    echo "$s found in the array";
}
else{
    echo"$s not found in the array";
}
?>
