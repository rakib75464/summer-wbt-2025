<?php
echo "Simple Interest<br>";
$principal = 1000;
$rate = 5;
$time = 2;
$si = ($principal * $rate * $time) / 100;
echo "Principal = $principal, Rate = $rate%, Time = $time years<br>";
echo "Simple Interest = $si";