<?php
// function to format the values to 2 DP.
function formatNumber($value, $dp = 2) {
    return number_format($value, $dp); 
}