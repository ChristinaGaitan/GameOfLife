/*
 * Conjunto de funciones de JavaScript utilizadas tanto
 *  para modificar elementos de HTML como para las llamadas
 *  con AJAX a archivos de PHP
*/

/*
 * @Descripcion: pinta el conjunto de Canvas (cuyo ID esta contenido
 *               en el array recibido) con el color especificado.
 * @Parametros: arrayIdCanvas = array de strings de 1 dimension que contiene
 *                              los IDs de los Canvas a pintar,
 *              color = stringo con el color utilizado para pintar.
 * @Return: Nada
*/
    function pintar(arrayIdCanvas,color)
    {
        arrayIdCanvas.forEach(function(idCanvas) {
            var c = document.getElementById(idCanvas);
            var ctx = c.getContext("2d");
            ctx.fillStyle = color;
            ctx.fillRect(0,0,c.width,c.height);
        });
    }
    
/*
 * @Descripcion: incrementa en 1 el valor contenido en un elemento de texto.
 * @Parametros: idElemento = id del elemento de texto cuyo valor se incrementara.
 * @Return: Nada (Modificacion directa al elemento de HTML).
*/
    function incrementText(idElemento)
    {
        var e = document.getElementById(idElemento);
        e.textContent=Number(e.textContent)+1;
    }

    var X=0;
    var Y=0;
    var ciclo;

/*
 * @Descripcion: inicia el proceso del juego mandando llamar, con AJAX,
 *               el archivo de PHP (V_BigBang.php) que da inicio a la 
 *               generacion y llenado random del tablero.
 * @Parametros: tamanioX = numero de columnas del tablero,
 *              tamanioY = numero de filas del tablero,
 *              velocidad = velocidad en segundos en la que se 
 *                          refrescara el tablero
 * @Return: Nada (Envia el control a PHP).
*/
    function iniciarProceso(tamanioX, tamanioY, velocidad){
        detenerCicloAnterior();
        
        X=tamanioX;
        Y=tamanioY;
        
        var parametros = {
                "tamanioX" : tamanioX,
                "tamanioY" : tamanioY,
                "velocidad" : velocidad
        };
        $.ajax({
                data:  parametros,
                url:   'V_BigBang.php',
                type:  'post',
                beforeSend: function () {
                        $("#areatexto").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#areatexto").html(response);
                }
        });     
    }
    
/*
 * @Descripcion: continua con el proceso del juego mandando llamar, con AJAX,
 *               el archivo de PHP (V_JugarCelulas.php) que aplica
 *               las reglas del Juego de la Vida y refresca el llenado del tablero.
 * @Parametros: tableroActual = arreglo de dos dimensiones que contiene el estado
 *                              actual del tablero
 * @Return: Nada (Envia el control a PHP).
*/
    function continuarProceso(tableroActual)
    {
        var parametros = {
                "tamanioX" : X,
                "tamanioY" : Y,
                "velocidad" : document.getElementById("velocidad").value,
                "tableroActual" : tableroActual
        };
        //Se hace esta asignacion a la variable global "ciclo" para poder abortar
        //la ejecucion de la funcion de AJAX cada que el usuario
        //reinicie el proceso
        ciclo =$.ajax({
                data:  parametros,
                url:   'V_JugarCelulas.php',
                type:  'post',
                success:  function (response) {
                        $("#divTablero").html(response);
                }
        });
    }
    
/*
 * @Descripcion: aborta la funcion contenida en la variable global "ciclo"
 * @Parametros: Ninguno.
 * @Return: Nada.
*/
    function detenerCicloAnterior()
    {
        if ((ciclo === undefined)===false) {
            ciclo.abort();
        }
    }