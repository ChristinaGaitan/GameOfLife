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
            function pintar(idCanvas,color)
            {
                var c = document.getElementById(idCanvas);
                var ctx = c.getContext("2d");
                ctx.fillStyle = color;
                ctx.fillRect(0,0,c.width,c.height);
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
            $tamanioX = $_POST['tamanioX'];
            $tamanioY = $_POST['tamanioY'];
            $numGeneraciones = $_POST['numGeneraciones'];
        ?>
        <form name="form" action="" method="post">
            
            <label for="tamanioY">Tamaño del grid en X: </label>
            <input type="number" name="tamanioY" min="2" max="100" value="<?php echo $tamanioY;?>">
            <br/>
            <label for="tamanioX">Tamaño del grid en Y: </label>
            <input type="number" name="tamanioX" min="2" max="100" value="<?php echo $tamanioX;?>">
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
                    $tableroActual=bigBang($tamanioX,$tamanioY);
                    
                    for ($g=1;$g<=$numGeneraciones;$g++)
                    {
                        colorearTableroCanvas($tableroActual,$tamanioX,$tamanioY);
                        echo "<script>updateValor('numGeneracion','".$g."');</script>";
                        sleep(2);
                        flush($secSleep);
                        
                        $tableroActual = jugarConCelulas($tableroActual,$tamanioX,$tamanioY);
                    }//Fin for Numero de generacion
                }

                function dibujarTableroCanvas($tamanioX,$tamanioY,$anchoBox,$altoBox)
                {
                    for ($x=0;$x<$tamanioX;$x++)
                    {
                        for ($y=0;$y<$tamanioY;$y++)
                        {

                            $idCanvas = "canvas".$x."_".$y;

                            echo("<canvas class='small' id='".$idCanvas."' ");
                            echo("width='".$anchoBox."' height='".$altoBox."'");
                            echo("style='border:1px solid #000000;'>");
                            echo ("</canvas>");


                        }//Fin for Y
                        echo ("<br/>");
                    }//Fin for X
                    
                }
                
                function colorearTableroCanvas($tableroActual,$tamanioX,$tamanioY)
                {
                    for ($x=0;$x<$tamanioX;$x++)
                    {
                        for ($y=0;$y<$tamanioY;$y++)
                        {

                            $idCanvas = "canvas".$x."_".$y;

                            if ($tableroActual[$x][$y]==1)
                            {
                                echo "<script>pintar('$idCanvas','Green');</script>";
                            }
                            else
                            {

                                echo "<script>pintar('$idCanvas','White');</script>";
                            }
                        }//Fin for Y
                    }//Fin for X
                    
                }
                

                function bigBang($tamanioX,$tamanioY) 
                {
                    $tableroInicial[$tamanioX][$tamanioY];
                    for ($x=0;$x<$tamanioX;$x++)
                    {
                        for ($y=0;$y<$tamanioY;$y++)
                        {
                            $tableroInicial[$x][$y] = rand(0,1);
                        }
                    }
                    return $tableroInicial;
                }
                
                function jugarConCelulas($tableroActual,$tamanioX,$tamanioY)
                {
                    $tableroSiguiente[$tamanioX][$tamanioY];
                    for ($x=0;$x<$tamanioX;$x++)
                    {
                        for ($y=0; $y< $tamanioY; $y++)
                        {
                            $tableroSiguiente[$x][$y] = getEstadoCelularNuevo($tableroActual,$x,$y,$tamanioX,$tamanioY); 
                        }//Fin for Y
                    }//Fin for X
                    return $tableroSiguiente; // prints the board
                }
                
                function getEstadoCelularNuevo($tableroActual,$x,$y)
                {        
                    $estadoCelularNuevo=0;
                    $vecinosVivos = getNumVecinosVivos($tableroActual,$x,$y);        

                    if($tableroActual[$x][$y]==1)
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
                    $colDerecha=$x+1;
                    $colIzquierda=$x-1;
                    $filaSuperior=$y-1;
                    $filaInferior=$y+1;
                    
                    //1. Superior Izquierda
                    if ($tableroActual[$colIzquierda][$filaSuperior]==1){
                            $nc ++;
                    }
                    //2.  Superior
                    if ($tableroActual[$x][$filaSuperior]==1){
                            $nc++;
                    }
                    //3. Suerior Derecha
                    if ($tableroActual[$colDerecha][$filaSuperior]==1){
                            $nc++;
                    }     
                    //4. Derecha
                    if ($tableroActual[$colDerecha][$y]==1){
                            $nc++;
                    }
                    //5. Inferior Derecha
                    if ($tableroActual[$colDerecha][$filaInferior]==1){
                            $nc++;
                    }
                    //6. Inferior
                    if ($tableroActual[$x][$filaInferior]==1){
                            $nc++;
                    }
                    //7. Inferior Izquierda
                    if ($tableroActual[$colIzquierda][$filaInferior]==1){
                            $nc ++;
                    }
                    //8. Izquierda
                    if ($tableroActual[$colIzquierda][$y]==1){
                            $nc ++;
                    }
		return $nc;
	}
            ?>
        </div>
    </body>
</html>
