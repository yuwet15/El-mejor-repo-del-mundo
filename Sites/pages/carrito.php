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
	    <th>Quitar</th>
	    </tr>
	  </thead>
	  
	  <tbody>
		<tr> 
			<td>$i[0]</td> 
			<td>$i[1]</td> 
	        <td>$i[2]</td>
	        <td>
	        	<div class="form-group w-25">
	        		<input type="number" class="form-control" name="ca" id="ca" min="0" max="1">
	        	</div>
	        	<button class="btn btn-primary" type="submit">Button</button>
	        <td>

	    </tr>
	  </tbody>
	</table>

</div>