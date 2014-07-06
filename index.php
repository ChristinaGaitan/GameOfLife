<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Game of Life</title>
        
        <link href="CSS/css_GameOfLife.css" rel="stylesheet" type="text/css" media="screen"/>
        <script type="text/javascript" src="JavaScript/js_GameOfLife.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-1.11.1.min.js"></script>

    </head>
    
    <body id="inicio">
        <div id="wrapper">
            <div id="encabezado">
                <a target="blank" href="http://en.wikipedia.org/wiki/Conway's_Game_of_Life">Game of Life</a>
                
            </div>  <!-- Fin encabezado -->


            
            <div id="parametros">
                <br/>
                <form name="form" action="" method="post">

                    <label for="tamanioX">Número de columnas: </label>
                    <input type="number" id="tamanioX" name="tamanioX" min="2" value="<?php echo $tamanioX;?>">
                    <br/>
                    <label for="tamanioY">Número de filas: </label>
                    <input type="number" id="tamanioY" name="tamanioY" min="2" value="<?php echo $tamanioY;?>">
                    <br/>
                    <label for="velocidad">Velocidad (segundos): </label>
                    <input type="number" id="velocidad" step="0.1" name="velocidad" min="0" 
                           value="<?php if($velocidad==0){echo "1";}
                                        else {echo $velocidad;}?>">
                    <br/>
                    <input type="hidden" id="jsonHidden" name="jsonHidden"
                           value="">
                        
                    <input type="button" href="javascript:;" 
                           onclick="iniciarProceso($('#tamanioX').val(),
                                                    $('#tamanioY').val(),
                                                    $('#velocidad').val());return false;" 
                           value="Iniciar" name="iniciar">
                </form>
            </div> <!-- Fin parametros -->
            <br/>

            
            <div id="areatexto">

            </div> <!-- Fin areatexto -->

             <div id="datos">
                
                <address>
                    Luz Christina Gaitán Torres
                    <br />
                    Email christina.gaitan@gmail.com &middot; Tel 312 122 57 40 
                    <br/>
                     Lapislázuli #1858 &middot; Fracc. Diamantes &middot; Colima, Colima.
                </address>
            </div> <!-- Fin pie -->
            
            <br/>
    </div> <!-- Fin #wrapper -->



</body>
</html>

