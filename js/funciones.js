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
        }else{
            document.getElementById("registerbutton").style.display = "none";
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
    //post values to save on DB
    $.post("guardaracceso.php", {tipo: tipo,nombre: nombre,marca: marca,modelo: modelo,
        color: color,placas: placas,inicio: inicio,fin: fin,}, 
        function(result){
           /* if(result == 1){
                alert("Registro Exitoso!!");
                qrgen();
            }else{
                alert(result);
                location.reload();
            }*/
            if(result == 0){
                alert("Error, intente de nuevo");
                location.reload();               
            }else{
                //alert(result);
                qrgen(result);                              
            }
            
      });
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