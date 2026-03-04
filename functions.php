<?php
function validateNumber($value) {
    return is_numeric($value) && $value > 0;
}

function computeTotal($price, $qty) {
    return $price * $qty;
}

function redirectTo($page) {
    header("Location: $page");
    exit();
}
?>