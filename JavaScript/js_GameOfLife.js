/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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


    
    function updateText(idElemento,valor)
    {
        var e = document.getElementById(idElemento);
        e.textContent=valor;
    }
    
    function incrementText(idElemento)
    {
        var e = document.getElementById(idElemento);
        e.textContent=Number(e.textContent)+1;
    }
    
    function updateWidth(idElemento,valor)
    {
        var e = document.getElementById(idElemento);
        e.width=valor;
    }
    
    function updateOverflow(idElemento,valor)
    {
        document.getElementById(idElemento).style.overflow=valor;
        alert(valor);
    }
    

    function continuarProceso(tableroActual)
    {
        var parametros = {
                "tamanioX" : document.getElementById("tamanioX").value,
                "tamanioY" : document.getElementById("tamanioY").value,
                "velocidad" : document.getElementById("velocidad").value,
                "tableroActual" : tableroActual
        };
        $.ajax({
                data:  parametros,
                url:   'V_JugarCelulas.php',
                type:  'post',
                success:  function (response) {
                        $("#divTablero").html(response);
                }
        });
    }

    function iniciarProceso(tamanioX, tamanioY, velocidad){
        
        document.getElementById("jsonHidden").value="";
        
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

