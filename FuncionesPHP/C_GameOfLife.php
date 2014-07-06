<?php

/*
 * Conjunto de funciones que involucran tanto a la Vista (HTML)
 * como al Modelo (matrices y variables de PHP).
*/


/*
  * @Descripcion: dibuja un tablero compuesto de varios Canvas usando HTML,
  *               cada uno de los Canvas tiene un ID que señala
  *               su posicion en el tablero.
  * @Parametros: $tamanioX = cantidad de columnas,
  *              $tamanioY = cantidad de filas,
  *              $anchoBox = ancho de los Canvas,
  *              $altoBox = alto de los Canvas
  * @Return: Nada
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

            }//Fin for X
            echo ("<br/>");
        }//Fin for Y

    }

/*
 * @Descripcion: colorea los Canvas contenidos en un tablero
 *               ubicandolos de acuerdo a su ID.
 *               NOTA: Esta funcion debe usarse en conjunto con "dibujarTableroCanvas(...)"
 * @Parametros: $tableroActual = matriz de 2 dimensiones que 
 *                                contiene valores entre 0 y 1,
 *                                los elementos con valor = 1
 *                                seran pintados de $color y los
 *                                que tienen valor = 0 seran 
 *                                pintados con color blanco.
 *                $color = indica el color que se usara para
 *                          colorear los elementos con valor=1.
 * @Return: Nada
 */
    function colorearTableroCanvas($tableroActual,$color)
    {
        $tamanioY = getLenghtY($tableroActual); 
        $tamanioX = getLenghtX($tableroActual); 
        
        $gi=0;
        $wi=0;
        
        //Almacenan las cadenas que se usara para generar los arrays de JS
        $strIdCanvasColor=''; 
        $strIdCanvasWhite='';
        
        for ($y=0;$y<$tamanioY;$y++)
        {
            for ($x=0;$x<$tamanioX;$x++)
            {
                $idCanvas = "canvas".$y."_".$x;

                if ($tableroActual[$y][$x]==1)
                {
                    //Si el valor = 1 se almacena en la cadena
                    //de color
                    if($gi==0)
                    {
                        $strIdCanvasColor="'".$idCanvas."'";
                    }
                    else
                    {
                        $strIdCanvasColor=$strIdCanvasColor.",'".$idCanvas."'";
                    }
                    $gi++;
                }
                elseif($tableroActual[$y][$x]==0)
                {
                    //Si el valor = 1 se almacena en la cadena
                    //de blancos
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
            }//Fin for X
        }//Fin for Y
        
        //Usando las cadenas generadas en los ciclos se genera codigo de JS.
        //El código JS  manda llamara la funcion encargada de colorear los Canvas
        echo "<script>"
        . "     var arrayColorIds = [$strIdCanvasColor]; "
        . "     pintar(arrayColorIds,'".$color."');"
        . "     var arrayWhiteIds = [$strIdCanvasWhite]; "
        . "     pintar(arrayWhiteIds,'White');"
        . "</script>";
                    
    }

