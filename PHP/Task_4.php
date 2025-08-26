<?php
$a = 25;
$b = 40;
$c = 30;

if ($a >= $b && $a >= $c) {
    echo "Largest number is $a";
} elseif ($b >= $a && $b >= $c) {
    echo "Largest number is $b";
} else {
    echo "Largest number is $c";
}
?>
