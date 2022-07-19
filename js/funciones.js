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
            if(result == 1){
                alert("Registro Exitoso!!");
                qrgen();
            }else{
                alert(result);
                location.reload();
            }
            
      });
}

function qrgen(){
    document.getElementById("modbody").innerHTML = "";
    document.getElementById("modfoot").innerHTML = '<button type="button" onclick="downqr()" class="btn btn-block btn-info">Descargar QR</button>';
    
    var qrcode = new QRCode("qrgen");

    qrcode.makeCode("www.qgsolutions.mx");
}

function downqr(){
    alert("Descargando QR...");
    location.reload();
}