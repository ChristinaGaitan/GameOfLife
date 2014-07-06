<?php

/*
 * Archivo que continua con proceso del Juego de la Vida,
 * podria considerarse como el orquestador de las iteraciones
 * del juego en las que ya se aplican las reglas del juego.
*/
    include ('FuncionesPHP/M_GameOfLife.php');
    include ('FuncionesPHP/C_GameOfLife.php');
    include ('FuncionesPHP/M_Generales.php');

    //Parametros recibidos a traves de AJAX
    $tamanioX = $_POST['tamanioX'];
    $tamanioY = $_POST['tamanioY'];
    $velocidad = $_POST['velocidad'];
    //Se decodifica el objeto JSON recibido como parametro
    $tableroActual = json_decode($_POST['tableroActual']);

    $anchoBox = 10;
    $altoBox = 10;

    //Se hace una pausa en la ejecucion de acuerdo al valor recibido como $velocidad
    sleep($velocidad);
    flush();

    //Se dibuja el tablero
    dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox);
    
    //Se llena la matriz del tablero aplicando las reglas del juego
    $tableroActual = jugarConCelulas($tableroActual);
    
    //Se colorea el tablero, con color blanco los elementos = 0 y 
    //con el color especificado los elementos = 1.s
    colorearTableroCanvas($tableroActual,"#801638");
    echo "<script>incrementText('numGeneracion');</script>";

    //Se codifica en JSON el tablero generado en esta iteracion
    $json = json_encode($tableroActual);
    
    //Se manda llamara la funcion de JavaScript que cotinuara con el proceso
    //enviando como parametro el objeto JSON con el tabler generado
    //
    //Podria decirse que se trata de una funcion recursiva ya que 
    //la funcion de JavaScript regresara a este mismo archivo.
    //Esta recursividad se detiene usando la funcion "detenerCicloAnterior()"
    //que actualmente es ejecutada en la funcion "iniciarProceso(...)"
    echo "<script>continuarProceso('".$json."');</script>";