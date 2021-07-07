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
	        	<form class="form-inline justify-content-center" method="post">
		          <div class="input-group">
		            <input type="number" name="numDays" id="numDays" class="numDays form-control">
		            <span class="input-group-btn">
		          		<button type="submit" name="button" class="btn btn-success" id="bt">Click <i class="fa fa-angle-right"></i></button>
		          	</span>
		          </div>
		        </form>
	        <td>

	    </tr>
	  </tbody>
	</table>

</div>