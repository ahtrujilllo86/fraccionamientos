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