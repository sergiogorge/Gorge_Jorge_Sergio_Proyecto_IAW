
function validarPasswd() {
  var p1 = document.getElementById("npassword").value;
  var p2 = document.getElementById("ncpassword").value;
  if (p1.length == 0 || p2.length == 0) {
    alert("Las contraseñas no pueden estar vacías");
    return false;
  }  if (p1.length != p2.length) {
      alert("Las contraseñas deben ser igual de largas");
      return false;
    } if (p1 != p2) {
  alert("Las contraseñas deben coincidir");
  return false;
} else {

  return true;
}

}
