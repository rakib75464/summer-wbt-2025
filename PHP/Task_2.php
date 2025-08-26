<?php
$amount = 2000;
$vat = $amount * 0.15;

echo "Amount: $amount<br>";
echo "VAT (15%) = $vat<br>";
echo "Total with VAT = " . ($amount + $vat);
?>
