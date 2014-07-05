<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            function pintar(arrayIdCanvas,color)
            {
                arrayIdCanvas.forEach(function(idCanvas) {
                    var c = document.getElementById(idCanvas);
                    var ctx = c.getContext("2d");
                    ctx.fillStyle = color;
                    ctx.fillRect(0,0,c.width,c.height);
                });
            }
            
            function updateValor(idLabel,valor)
            {
                var l = document.getElementById(idLabel);
                l.textContent=valor;

            }

        </script>

        <style>
            #divTablero
            {
                text-align: center;
                font-size: 1px;
            }
</style>

    </head>
    <body>
        <?php
            include ('Funciones/M_GameOfLife.php');
            include ('Funciones/C_GameOfLife.php');
            include ('Funciones/M_Generales.php');
            
            $tamanioX = $_POST['tamanioX'];
            $tamanioY = $_POST['tamanioY'];
            $numGeneraciones = $_POST['numGeneraciones'];
        ?>
        <form name="form" action="" method="post">
           
            <label for="tamanioX">Tamaño del grid en X: </label>
            <input type="number" name="tamanioX" min="2" max="100" value="<?php echo $tamanioX;?>">
            <br/>
            <label for="tamanioY">Tamaño del grid en Y: </label>
            <input type="number" name="tamanioY" min="2" max="100" value="<?php echo $tamanioY;?>">
            <br/>
            <label for="numGeneraciones">Numero de Generaciones: </label>
            <input type="number" name="numGeneraciones" min="1" max="10000"
                   value="<?php if($numGeneraciones==0) echo(1000);
                                else echo $numGeneraciones;?>">
            <br/>
            <input type="submit" value="Iniciar" name="iniciar">
            
            <br/>
            <label>Generacion: </label>
            <label id="numGeneracion">0 </label>
        </form>
        <div id="divTablero">

            <?php
                $tamanioGrid = $tamanioX*$tamanioY;
                if (($tamanioGrid>0) && ($numGeneraciones>0))
                {
                    
                    $anchoBox = 10;
                    $altoBox = 10;
                    $secSleep = 2;
                    
                    set_time_limit (($numGeneraciones+1)*$secSleep);
                    
                    dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox);
                    $tableroActual=bigBang($tamanioY,$tamanioX);
                    
                    for ($g=1;$g<=$numGeneraciones;$g++)
                    {
                        colorearTableroCanvas($tableroActual);
                        echo "<script>updateValor('numGeneracion','".$g."');</script>";
                        sleep(1);
                        flush($secSleep);
                        
                        $tableroActual = jugarConCelulas($tableroActual);
                    }//Fin for Numero de generacion
                }
            ?>
        </div>
    </body>
</html>
