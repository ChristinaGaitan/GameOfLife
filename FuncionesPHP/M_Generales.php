<?php
/*
 * Conjunto de funciones generales 
 * que pueden ser reusadas en otras aplicaciones 
*/


/*
  * @Descripcion: regresa el tamañao del eje Y (filas) de un array de 2 dimensiones.
  * @Parametros: $matriz = matriz de 2 dimensiones
  * @Return: int
*/
function getLenghtY($matriz)
{
    return sizeof($matriz);
}

/*
  * @Descripcion: regresa el tamañao del eje X (columnas) de un array de 2 dimensiones.
  * @Parametros: $matriz = matriz de 2 dimensiones
  * @Return: int
*/
function getLenghtX($matriz)
{
    $tamanioY = getLenghtY($matriz);
    $totalElementos = count($matriz, 1)-$tamanioY;
    $tamanioX = $totalElementos/$tamanioY;
    
    return $tamanioX;
}