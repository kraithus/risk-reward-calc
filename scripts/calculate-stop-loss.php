<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderType = $_POST['orderType'];
    $orderPrice = $_POST['orderPrice'];
    $takeProfit = $_POST['takeProfit'];


    if ($orderType == 'buy') {
        $reward = $takeProfit - $orderPrice;
        $stopLoss = $orderPrice - ($reward / 3);
    }

    elseif ($orderType == 'sell') 
    {
        $reward = $orderPrice - $takeProfit;
        $stopLoss = $orderPrice + ($reward / 3);
    }

    // Output the value so js can receive it
    //$formattedNumber = number_format($stopLoss, 2);
    //echo $formattedNumber;

    // function to format the values to 2 DP.
    function formatNumber($value, $dp = 2) {
        return number_format($value, $dp); 
    }
    

    $stoplossFormatted = formatNumber($stopLoss);
    $data = array (
        "stopLoss" => $stoplossFormatted,
    );

    echo json_encode($data);
}    


