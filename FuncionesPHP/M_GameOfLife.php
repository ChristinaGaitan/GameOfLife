<?php

/*
 * Conjunto de funciones usadas para implementar las reglas
 * del Juego de la Vida, estas funciones son consideradas
 * como parte del Modelo del negocio.
*/

/*
 * @Descripcion: genera una matriz de dos dimensiones de tamanio 
 *               $tamanioY x $tamanioX y llena cada uno de sus elementos
 *               con valores random entre 1 y 0.
 * @Parametros: $tamanioX = cantidad de columnas,
 *              $tamanioY = cantidad de filas,
 * @Return: $matriz[$tamanioY][$tamanioX] con valores random entre 1 y 0.
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

    
/*
 * @Descripcion: recorre cada una de las posiciones en la matriz de 2 
 *               dimensiones ($tableroActual) para asignarle su nuevo
 *               valor de acuerdo a las reglas del juego.
 * @Parametros: $tableroActual = matriz de 2 dimensiones que contiene
 *                               valores entre 1 y 0
 * @Return: $tableroSiguiente con valores entre 1 y 0.
*/
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

/*
 * @Descripcion: aplica el conjunto de reglas del Juego de la Vida
 *               tomando en cuenta el valor del elemento evaluado
 *               y el de sus vecinos.
 * @Parametros: $tableroActual = matriz de 2 dimensiones que contiene
 *                               valores entre 1 y 0.
 *              $x,$y = indican la posicion que esta siendo evaluada.
 * @Return: $estadoCelularNuevo= 1 o 0.
*/
    function getEstadoCelularNuevo($tableroActual,$x,$y)
    {        
        $estadoCelularNuevo=0;
        $vecinosVivos = getNumVecinosVivos($tableroActual,$x,$y);        

        if($tableroActual[$y][$x]==1)
        {
            //CELULAS VIVAS
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
            //CELULAS MUERTAS
            if($vecinosVivos==3)
            {
            //4. Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.
            $estadoCelularNuevo=1;
            }
        }
        return $estadoCelularNuevo;

    }

/*
 * @Descripcion: evalua el estado de cada uno de los 8 vecinos
 *               del elemento en la posicion $x,$y para obtener 
 *               el numero de vecinos "vivos".
 * @Parametros: $tableroActual = matriz de 2 dimensiones que contiene
 *                               valores entre 1 y 0.
 *              $x,$y = indican la posicion que esta siendo evaluada.
 * @Return: $nc numero de vecinos vivos.
*/
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

