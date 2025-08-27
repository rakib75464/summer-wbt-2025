<?php
echo "Prime Numbers from 1 to 50<br>";
for ($n = 2; $n <= 50; $n++) {
    $isPrime = true;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            $isPrime = false;
            break;
        }
    }
    if ($isPrime) {
        echo $n . " ";
    }
}
echo "<br>";
?>