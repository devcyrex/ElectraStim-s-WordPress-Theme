<?php


function remove_vat($label, $formattedPrice, $order){

    if($label === "Total:"){

        return $order->get_total();
    }

    return $formattedPrice;
}