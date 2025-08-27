<?php
echo "Leap Year Check<br>";
$year = 2024;
if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "$year is a Leap Year<br><br>";
} else {
    echo "$year is NOT a Leap Year<br><br>";
}
?>