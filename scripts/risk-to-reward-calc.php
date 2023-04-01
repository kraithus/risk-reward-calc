<?php
require 'custom_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lotSize = $_POST['lotSize'];
    $orderPrice = $_POST['orderPrice'];
    $orderType = $_POST['orderType'];
    $stopLoss = $_POST['stopLoss'];
    $takeProfit = $_POST['takeProfit'];


    if ($orderType == 'buy') {
        $takeProfitOrderPriceDiff = $takeProfit - $orderPrice;
        $profit = $lotSize * $takeProfitOrderPriceDiff;

        $stopLossOrderPriceDiff = $stopLoss - $orderPrice;
        $loss = $lotSize * $stopLossOrderPriceDiff;

        // multiply by -1 so that the profit value in loss:profit is outputted as a positive integer.
        $profitRation = ($profit / $loss) * -1;;

        $profitRationFormatted = formatNumber($profitRation);

        $riskToRewardRatio = "1 : " . $profitRationFormatted;
    }

    /**
     * Because sell amount is higher than take profit amount
     * in order to get a positive profit.
     */
    elseif ($orderType == 'sell') 
    {   
        $orderPriceTakeProfitDiff = $orderPrice - $takeProfit;
        $profit =  $lotSize * $orderPriceTakeProfitDiff;

        $orderPriceStopLossDiff = $orderPrice - $stopLoss;
        $loss = $lotSize * $orderPriceStopLossDiff;

        $profitRation = ($profit / $loss) * -1;

        $profitRationFormatted = formatNumber($profitRation);

        $riskToRewardRatio = "1 : " . $profitRationFormatted;
    }

    $profitFormatted = formatNumber($profit);
    $lossFormatted = formatNumber($loss);
    
    // return the data as json
    $data = array(
        "profit" => '$' . $profitFormatted,
        "loss" => '$' . $lossFormatted,
        "ratio" => $riskToRewardRatio,
    );

    echo json_encode($data);
}

