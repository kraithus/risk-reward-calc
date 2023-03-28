<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderType = $_POST['orderType'];
    $orderPrice = $_POST['orderPrice'];
    $takeProfit = $_POST['takeProfit'];


    if ($orderType == 'buy') {
        $reward = $takeProfit - $orderPrice;
        $stopLoss = $orderPrice - ($reward / 2);
    }

    elseif ($orderType == 'sell') 
    {
        $reward = $orderPrice - $takeProfit;
        $stopLoss = $orderPrice + ($reward / 2);
    }

    // Output the value so js can receive it
    $formattedNumber = number_format($stopLoss, 2);
    echo $formattedNumber;
}

