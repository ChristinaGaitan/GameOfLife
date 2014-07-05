<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    function bigBang($tamanioY,$tamanioX) 
    {        
        $tableroInicial[$tamanioY][$tamanioX];
        
        for ($y=0;$y<$tamanioY;$y++)
        {
            for ($x=0;$x<$tamanioX;$x++)
            {
                $tableroInicial[$y][$x] = rand(0,1);
            }
        }
        
        return $tableroInicial;
    }

    function jugarConCelulas($tableroActual)
    {
        $tamanioY = getLenghtY($tableroActual); 
        $tamanioX = getLenghtX($tableroActual); 
        
        $tableroSiguiente[$tamanioY][$tamanioX];
        for ($y=0;$y<$tamanioY;$y++)
        {
            for ($x=0;$x<$tamanioX;$x++)
            {
                $tableroSiguiente[$y][$x] = getEstadoCelularNuevo($tableroActual,$x,$y); 
            }//Fin for X
        }//Fin for Y
        return $tableroSiguiente; // prints the board
    }

    function getEstadoCelularNuevo($tableroActual,$x,$y)
    {        
        $estadoCelularNuevo=0;
        $vecinosVivos = getNumVecinosVivos($tableroActual,$x,$y);        

        if($tableroActual[$y][$x]==1)
        {
            //Celulas vivas
            if($vecinosVivos<2)
            {
                //1. Any live cell with fewer than two live neighbours dies, as if caused by under-population.
                $estadoCelularNuevo=0;
            }
            elseif(($vecinosVivos==2)||($vecinosVivos==3))
            {
                //2. Any live cell with two or three live neighbours lives on to the next generation.
                $estadoCelularNuevo=1;
            }
            elseif($vecinosVivos>3)
            {
                //3. Any live cell with more than three live neighbours dies, as if by overcrowding.
                $estadoCelularNuevo=0;
            }
        }
        else
        {
            //Celulas muertas
            if($vecinosVivos==3)
            {
            //4. Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.
            $estadoCelularNuevo=1;
            }
        }
        return $estadoCelularNuevo;

    }

    function getNumVecinosVivos($tableroActual,$x,$y)
    {
        $nc = 0;
        $colDerecha=$y+1;
        $colIzquierda=$y-1;
        $filaSuperior=$x-1;
        $filaInferior=$x+1;

        //1. Superior Izquierda
        if ($tableroActual[$colIzquierda][$filaSuperior]==1){
                $nc ++;
        }
        //2.  Superior
        if ($tableroActual[$y][$filaSuperior]==1){
                $nc++;
        }
        //3. Suerior Derecha
        if ($tableroActual[$colDerecha][$filaSuperior]==1){
                $nc++;
        }     
        //4. Derecha
        if ($tableroActual[$colDerecha][$x]==1){
                $nc++;
        }
        //5. Inferior Derecha
        if ($tableroActual[$colDerecha][$filaInferior]==1){
                $nc++;
        }
        //6. Inferior
        if ($tableroActual[$y][$filaInferior]==1){
                $nc++;
        }
        //7. Inferior Izquierda
        if ($tableroActual[$colIzquierda][$filaInferior]==1){
                $nc ++;
        }
        //8. Izquierda
        if ($tableroActual[$colIzquierda][$x]==1){
                $nc ++;
        }
    return $nc;
}

