<?php

function calculateTotalPrice(array $productPrice, array $productNumber, array &$subTotal, float &$priceNoVat, float &$priceWithVat,float &$vat, float $percentVat = 7) {
    $priceNoVat = 0;
    for($i = 0; $i < count($productPrice); $i++)
    {
        $subTotal[$i] = $productPrice[$i] * $productNumber[$i];

        $priceNoVat += + $subTotal[$i];

    }
    $vat = number_format(($priceNoVat * $percentVat)/100,2);
    $priceWithVat = $priceNoVat*(1+$percentVat/100);

}

function showTable(array $header, array $data){
    echo "<table class=\"table\" width=\"60%\" style=\"text-align: center; border: 1px solid black; margin:auto\">";
    echo "<tr>";
    foreach ($header as $h){
        echo "<th style=\"border: 1px solid black\">$h</th>";
    }
    echo "</tr>";
    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $col){
           echo "<td style='border: 1px solid black'>$col</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

