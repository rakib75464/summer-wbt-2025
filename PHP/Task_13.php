<?php
// Pattern 1
echo "Pattern 1<br>";
for ($i = 5; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<br>";

// Pattern 2
echo "Pattern 2<br>";
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}

echo "<br>";

// Pattern 3
echo "Pattern 3<br>";
$letter = 'A';
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $letter . " ";
    }
    $letter++;
    echo "<br>";
}
?>
