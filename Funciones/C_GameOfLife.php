<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox)
    {

        for ($y=0;$y<$tamanioY;$y++)
        {
            for ($x=0;$x<$tamanioX;$x++)
            {
                $idCanvas = "canvas".$y."_".$x;

                echo("<canvas class='small' id='".$idCanvas."' ");
                echo("width='".$anchoBox."' height='".$altoBox."'");
                echo("style='border:1px solid #000000;'>");
                echo ("</canvas>");


            }//Fin for Y
            echo ("<br/>");
        }//Fin for X

    }

    function colorearTableroCanvas($tableroActual)
    {
        $tamanioY = getLenghtY($tableroActual); 
        $tamanioX = getLenghtX($tableroActual); 
        
        $gi=0;
        $wi=0;
        $strIdCanvasGreen='';
        $strIdCanvasWhite='';
        for ($y=0;$y<$tamanioY;$y++)
        {
            for ($x=0;$x<$tamanioX;$x++)
            {
                $idCanvas = "canvas".$y."_".$x;

                if ($tableroActual[$y][$x]==1)
                {
                    if($gi==0)
                    {
                        $strIdCanvasGreen="'".$idCanvas."'";
                    }
                    else
                    {
                        $strIdCanvasGreen=$strIdCanvasGreen.",'".$idCanvas."'";
                    }
                    $gi++;
                }
                else
                {
                    if($wi==0)
                    {
                        $strIdCanvasWhite="'".$idCanvas."'";
                    }
                    else
                    {
                        $strIdCanvasWhite=$strIdCanvasWhite.",'".$idCanvas."'";
                    }
                    $wi++;
                }
            }//Fin for Y
        }//Fin for X
        
        echo "<script>"
        . "     var arrayGreenIds = [$strIdCanvasGreen]; "
        . "     pintar(arrayGreenIds,'Green');"
        . "     var arrayWhiteIds = [$strIdCanvasWhite]; "
        . "     pintar(arrayWhiteIds,'White');"
        . "</script>";
                    
    }

