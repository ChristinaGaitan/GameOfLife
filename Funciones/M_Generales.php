<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getLenghtY($matriz)
{
    return sizeof($matriz);
}


function getLenghtX($matriz)
{
    $tamanioY = getLenghtY($matriz);
    $totalElementos = count($matriz, 1)-$tamanioY;
    $tamanioX = $totalElementos/$tamanioY;
    
    return $tamanioX;
}