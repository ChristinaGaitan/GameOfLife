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
                    
                    $tamanioGrid = $tamanioX*$tamanioY;
                    if (($tamanioGrid>0) )
                    {
                        $anchoBox = 10;
                        $altoBox = 10;

                        echo("<div><spam id='leyendaNumGeneracion'>Generacion: </spam>"
                                . "<spam id='numGeneracion'>0 </spam></div><br/>");
                        
                        echo ("<div id='divTablero'>");

               
                        dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox);
                        $tableroActual=bigBang($tamanioY,$tamanioX);
                        
                        
                        colorearTableroCanvas($tableroActual);
                        echo "<script>incrementText('numGeneracion');</script>";

                        $json = json_encode($tableroActual);
                        echo "<script>continuarProceso('".$json."');</script>";
                        
                        echo (" </div><!-- Fin divTablero -->");

                    }
