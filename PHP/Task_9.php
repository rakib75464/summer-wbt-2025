<?php
echo "Swap two numbers<br>";
$a = 10;
$b = 20;
echo "Before Swap: a = $a, b = $b<br>";
$a = $a + $b;
$b = $a - $b;
$a = $a - $b;
echo "After Swap: a = $a, b = $b";
?>