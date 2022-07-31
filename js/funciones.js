function checkfracc(idfracc){
    $.post("checkfracc.php", {idfracc: idfracc}, function(result){
        if(result == "ok"){
            document.getElementById("registerform").style.display = "block";
        }else{
            document.getElementById("registerform").style.display = "none";
        }
        }); 
}

function checktoken(token){
    $.post("checktoken.php", {token: token}, function(result){
        if(result == "si"){
            document.getElementById("registerbutton").style.display = "block";
            document.getElementById("tokensi").style.display = "block";
            document.getElementById("tokenno").style.display = "none";
        }else{
            document.getElementById("registerbutton").style.display = "none";
            document.getElementById("tokensi").style.display = "none";
            document.getElementById("tokenno").style.display = "block";
        }
        }); 
}

function historial(){
    $("#principal").load("historico.php");
    document.getElementById("acctabla").innerHTML = "";
    $('.navbar-collapse').collapse('hide');
}
function configurar(){
    $("#principal").load("config.php");
    document.getElementById("acctabla").innerHTML = "";
    $('.navbar-collapse').collapse('hide');
}
function checkpass(iduser){
var pastpass = document.getElementById("antpassword").value;
 $.post("verifypass.php", {password: pastpass}, function(result){
   
    if(result == "ok"){
        document.getElementById("btnpass").disabled= false;
    }else{
        document.getElementById("btnpass").disabled= true;
    }
  });
}

function changepass(){
    var newpass = document.getElementById("newpass").value;
    $.post("changepass.php", {newpass: newpass}, function(result){
        alert(result);
        location.reload();
      });
}
function showautodiv(ch){
    if(ch == true){
      document.getElementById("autodatos").style.display = "block";   
    }else{
        document.getElementById("autodatos").style.display = "none"; 
        document.getElementById("marca").value = "";
        document.getElementById("modelo").value = "";
        document.getElementById("color").value = "";
        document.getElementById("placas").value = ""; 
    }   
}

function guardaracceso(){
    var tipo = document.getElementById("tipoacceso").value;
    var nombre = document.getElementById("nombrevisita").value;
    var marca = document.getElementById("marca").value;
    var modelo = document.getElementById("modelo").value;
    var color = document.getElementById("color").value;
    var placas = document.getElementById("placas").value;
    var inicio = document.getElementById("inicio").value;
    var fin = document.getElementById("fin").value;
    
    if(nombre == ""){
        alert("El campo Nombre no puede ir vacio");
    }else if(inicio == ""){
        alert("El campo fecha de inicio no puede ir vacio");
    }else if(fin == ""){
        alert("El campo fecha de fin no puede ir vacio");
    }else{
    //post values to save on DB
    $.post("guardaracceso.php", {tipo: tipo,nombre: nombre,marca: marca,modelo: modelo,
        color: color,placas: placas,inicio: inicio,fin: fin,}, 
        function(result){
                console.log(result);
            /**/
            if(result == 0){
                alert("Error en la consulta, intente de nuevo");
                location.reload();               
            }else if(result == 1){
                alert("Fecha de Inicio no valida, intente de nuevo");
                //location.reload();
            }else if(result == 2){
                alert("Fecha de Fin no valida, intente de nuevo");
                //location.reload();
            }else{
                //alert(result);
                qrgen(result);                              
            }   
                
      });
    }
    
}

function qrgen(indexacceso){
    $("#NuevoAcceso").modal();
    document.getElementById("qrgen").innerHTML = "";
    document.getElementById("modbody").innerHTML = "";
    document.getElementById("modfoot").innerHTML = '<button type="button" onclick="downqr()" class="btn btn-block btn-info">Guardar QR</button>';
   // document.getElementById("modfoot").innerHTML = '';
    var qrcode = new QRCode("qrgen");
    qrcode.makeCode("http://192.168.1.78/fraccionamientos/getqr.php?indexacceso=" + indexacceso);
}

function downqr(){

    var canvas = document.getElementById("canvasqr");
    var img    = canvas.toDataURL("image/png");
    const createEl = document.createElement('a');
    createEl.href = img;
    var filename = Math.floor(Math.random() * 100000000);
    createEl.download = filename + ".png";
    //createEl.download = "QRAccess.png";
    createEl.click();
    createEl.remove();
    location.reload();
}

function borraracceso(indexo){
    let erase = "Desea borrar este acceso?";
    if (confirm(erase) == true) {
        $.post("borraracceso.php", {indexo: indexo}, function(result){
            alert(result);
            //location.reload();
            configurar();
          });
    } else {
        alert("Operacion cancelada...");

    }

}

function guardarauto(ide){
    
    var marca = document.getElementById("newmarca").value;
    var modelo = document.getElementById("newmodelo").value;
    var color = document.getElementById("newcolor").value;
    var placas = document.getElementById("newplacas").value;

    $('#cancelnewauto').trigger('click');
    //$( ".action-close" ).trigger( "click" );

    $.post("guardarauto.php", {marca: marca,modelo: modelo,color: color,placas: placas},
     function(result){
        alert(result);
        configurar();
        
      });
    
}

function fillauto(idauto){
    
    if(idauto == "none"){
        document.getElementById("marca").value = "";
        document.getElementById("modelo").value = "";
        document.getElementById("color").value = "";
        document.getElementById("placas").value = "";
    }
    $.post("fillauto.php", {idauto: idauto},
    function(result){
       document.getElementById("marca").value = result.marca;
       document.getElementById("modelo").value = result.modelo;
       document.getElementById("color").value = result.color;
       document.getElementById("placas").value = result.placas;
     });
}

function editauto(idauto){
    $("#editAuto").modal('show');
    $.post("fillauto.php", {idauto: idauto},
    function(result){
       document.getElementById("ideauto").innerHTML = result.id;
       document.getElementById("editmarca").value = result.marca;
       document.getElementById("editmodelo").value = result.modelo;
       document.getElementById("editcolor").value = result.color;
       document.getElementById("editplacas").value = result.placas;
     });
     
}

function resaveauto(){
    let update = "Modificar datos de este Automovil?";
    if (confirm(update) == true) {
        var autoid = document.getElementById("ideauto").innerHTML;
        var marca = document.getElementById("editmarca").value;
        var modelo = document.getElementById("editmodelo").value;
        var color = document.getElementById("editcolor").value;
        var placas = document.getElementById("editplacas").value;
        $('#closemodaledit').trigger('click');
    
    
        $.post("resaveauto.php", {autoid: autoid,marca: marca,modelo: modelo,
            color: color,placas: placas},
        function(result){
           alert(result);
           configurar();
         });
    } else {
        alert("Operacion cancelada...");
        $('#closemodaledit').trigger('click');

    }


}

function deleteauto(){

    let erase = "Desea borrar este Automovil?";
    if (confirm(erase) == true) {
        var autoid = document.getElementById("ideauto").innerHTML;
        var marca = document.getElementById("editmarca").value;
        var modelo = document.getElementById("editmodelo").value;
        var color = document.getElementById("editcolor").value;
        var placas = document.getElementById("editplacas").value;
        $('#closemodaledit').trigger('click');
    
    
        $.post("deleteauto.php", {autoid: autoid},
        function(result){
           alert(result);
           configurar();
         });
    } else {
        alert("Operacion cancelada...");
        $('#closemodaledit').trigger('click');

    }
}

function mostrarContrasena(){
    var tipo = document.getElementById("password");
    var ruta = document.getElementById("showpass");
    
    if(tipo.type == "password"){
        tipo.type = "text";
        ruta.src = "img/eyeopen.png";
    }else{
        tipo.type = "password";
        
        ruta.src = "img/eyeclose.png";
    }
}



function mostrarnewContrasena(){
    var newtipo = document.getElementById("newpass");
    var newruta = document.getElementById("shownewpass");
    
    if(newtipo.type == "password"){
        newtipo.type = "text";
        newruta.src = "img/eyeopen.png";
    }else{
        newtipo.type = "password";
        
        newruta.src = "img/eyeclose.png";
    }
}

function mostrarantContrasena(){
    var anttipo = document.getElementById("antpassword");
    var antruta = document.getElementById("showantpass");
    
    if(anttipo.type == "password"){
        anttipo.type = "text";
        antruta.src = "img/eyeopen.png";
    }else{
        anttipo.type = "password";
        
        antruta.src = "img/eyeclose.png";
    }
}

function checkmail(){
    var correo = document.getElementById("mymail").value;
    $.post("verifymail.php", {correo: correo}, function(result){
    
        if(result == "ok"){
            document.getElementById("mytoken").style.display= "block";
            document.getElementById("textoguia").innerHTML= "Introduce el token que te enviamos cuando te registraste";
        }else{
            document.getElementById("mytoken").style.display= "none";
            document.getElementById("textoguia").innerHTML= "Introduce un correo electronico valido";
        }
        
    });
}

function verifytoken(){
    var token = document.getElementById("mytoken").value;
    var correo = document.getElementById("mymail").value;
    $.post("verifytoken.php", {token: token, correo: correo}, function(result){
    
        if(result == "si"){
            document.getElementById("camposnewpass").style.display= "block";
            document.getElementById("textoguia").innerHTML= "Introduce tu nueva contraseña";
        }else{
            document.getElementById("camposnewpass").style.display= "none";
            document.getElementById("textoguia").innerHTML= "Introduce el token que te enviamos cuando te registraste";
        }
        
    });
}

function storenewpass(){
    var correo = document.getElementById("mymail").value;
    var newpass = document.getElementById("newpassword").value;

    $.post("storenewpass.php", {newpass: newpass, correo: correo}, function(result){
    
        alert(result);
        location.href="index.html";
    });
}