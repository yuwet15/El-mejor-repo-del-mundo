var check = function() {
	if (document.getElementById('new_pass').value == '' || document.getElementById('confirm_pass').value == ''){
		document.getElementById('message').innerHTML = ''
	} else if (document.getElementById('new_pass').value ==
    document.getElementById('confirm_pass').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Contraseñas iguales';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Contraseñas no son iguales';
  }
}