<?php
echo "<h3>1. Star Triangle</h3>";
$rows = 3;
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

echo "<h3>2. Number Pattern</h3>";
for ($i = 3; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}

echo "<h3>3. Alphabet Pattern</h3>";
$rows = 3;
$char = 65; // ASCII value of 'A'
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo chr($char) . " ";
        $char++;
    }
    echo "<br>";
}
?>
