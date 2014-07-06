<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
                    include ('Funciones/M_GameOfLife.php');
                    include ('Funciones/C_GameOfLife.php');
                    include ('Funciones/M_Generales.php');
                    
                    $tamanioX = $_POST['tamanioX'];
                    $tamanioY = $_POST['tamanioY'];
                    $velocidad = $_POST['velocidad'];
                    $tableroActual = json_decode($_POST['tableroActual']);
                    
                    $anchoBox = 10;
                    $altoBox = 10;
                        
                    sleep($velocidad);
                    flush();
                    
                    
                    dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox);
                    $tableroActual = jugarConCelulas($tableroActual);
                    colorearTableroCanvas($tableroActual);
                    echo "<script>incrementText('numGeneracion');</script>";
                        
                    $json = json_encode($tableroActual);
                    echo "<script>continuarProceso('".$json."');</script>";