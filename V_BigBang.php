<?php
/*
 * Archivo que da inicio al proceso del Juego de la Vida,
 * podria considerarse como el orquestador de la primera iteracion
 * del juego en la cual se generan elementos random en el tablero.
*/

    include ('FuncionesPHP/M_GameOfLife.php');
    include ('FuncionesPHP/C_GameOfLife.php');
    include ('FuncionesPHP/M_Generales.php');

    //Parametros recibidos a traves de AJAX
    $tamanioX = $_POST['tamanioX'];
    $tamanioY = $_POST['tamanioY'];
    $velocidad = $_POST['velocidad'];

    $tamanioGrid = $tamanioX*$tamanioY;
    if (($tamanioGrid>0) )
    {
        $anchoBox = 10;
        $altoBox = 10;

        //Se generan elementos de HTML que serviran para mostrar el numero de iteraciones
        //(Generaciones) que se han realizado.
        echo("<div><spam id='leyendaNumGeneracion'>Generacion: </spam>"
                . "<spam id='numGeneracion'>0 </spam></div><br/>");

        //Se generan el div que contendra el tablero y que sera el que se 
        //refesque con las nuevas iteraciones
        echo ("<div id='divTablero'>");

        //Se dibuja el tablero del tamanio especificado en los paramtros recibidos
        dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox);
        
        //Se llena la matriz del tablero con elementos random entre 1 y 0
        $tableroActual=bigBang($tamanioY,$tamanioX);

        //Se colorea el tablero, con color blanco los elementos = 0 y 
        //con el color especificado los elementos = 1.
        colorearTableroCanvas($tableroActual,"#801638");
        echo "<script>incrementText('numGeneracion');</script>";

        //Se codifica en JSON el tablero generado en esta primera iteracion
        $json = json_encode($tableroActual);
        
        //Se manda llamara la funcion de JavaScript que cotinuara con el proceso
        //enviando como parametro el objeto JSON con el tabler generado
        echo "<script>continuarProceso('".$json."');</script>";

        echo (" </div><!-- Fin divTablero -->");

    }  
