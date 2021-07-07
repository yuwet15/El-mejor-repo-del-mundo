<?php 
session_start();
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}
?>


<div class="container">
  <table class="table">
  
	  <thead>
	    <tr>
	    <th>Producto</th>
	    <th>Cantidad</th>
	    <th>Tienda</th>
	    </tr>
	  </thead>
	  
	  <tbody>
		<tr> 
			<td>$i[0]</td> 
			<td>$i[1]</td> 
	        <td>$i[2]</td>
	    </tr>
	  </tbody>
	</table>

</div>