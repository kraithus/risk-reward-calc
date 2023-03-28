<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lotSize = $_POST['lotSize'];
    $orderType = $_POST['orderType'];
    $orderPrice = $_POST['orderPrice'];
    $takeProfit = $_POST['takeProfit'];


    if ($orderType == 'buy') {
        $priceDiff = $takeProfit - $orderPrice;
        $profit = $lotSize * $priceDiff;
    }

    /**
     * Because sell amount is higher than take profit amount
     * in order to get a positive profit.
     */
    elseif ($orderType == 'sell') 
    {   
        $priceDiff = $orderPrice - $takeProfit;
        $profit =  $lotSize * $priceDiff;
    }

    // Output the value so js can receive it
    $formattedNumber = number_format($profit, 2);
    echo '$' . $formattedNumber;
}

