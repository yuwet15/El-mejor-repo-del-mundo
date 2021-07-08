<?php 
session_start();
include('../config/conexion.php');
if (isset($_SESSION['rut'])){
  include('../templates/header.html');   
  include('../templates/body_postlogin.html'); 
} else {
  header("Location: ../index.php");
}?>
<form class="row g-4 needs-validation justify-content-center" name="form1"  method="post" action="" novalidate>
	<input type="text" class="form-control" name="rut" id="rut" required>
	<div class="col-12 text-center">
	    <button class="btn btn-primary" name="login" value="login" type="submit">Probar</button>
	  </div>
</form>

<table class="table">
    		
    <thead>
      <tr>
	      <th>1</th>
	      <th>2</th>
	      <th>3</th> 
	      <th>4</th> 
	      <th>5</th> 
	      <th>6</th> 
	      <th>7</th> 
	      <th>8</th> 
  		</tr>
  		</thead>
    
    <tbody>
    	<?php
			if (isset($_POST['login'])) {   
			    //session_start();
			    
			    $query = $_POST['rut'];
			    $result = $db -> prepare($query);
			    $result -> execute();
			 
			    $result = $result -> fetchAll();
			    foreach ($result as $i) {
			    	echo "<tr> <td>$i[0]</td> <td>$i[1]</td> <td>$i[2]</td> <td>$i[3]</td> <td>$i[4]</td> <td>$i[5]</td> <td>$i[6]</td> <td>$i[7]</td></tr>";
			    }
			}
			?>
    </tbody>
  </table>


<form class="row g-4 needs-validation justify-content-center" name="form1"  method="post" action="" novalidate>
	<input type="text" class="form-control" name="rut2" id="rut2" required>
	<div class="col-12 text-center">
	    <button class="btn btn-primary" name="login2" value="login2" type="submit">Probar</button>
	  </div>
</form> 

<table class="table">
    
    <thead>
      <tr>
	      <th>1</th>
	      <th>2</th>
	      <th>3</th> 
	      <th>4</th> 
	      <th>5</th> 
	      <th>6</th> 
	      <th>7</th> 
	      <th>8</th> 
  		</tr>
  		</thead>
    
    <tbody>
    	<?php
			if (isset($_POST['login2'])) {   
			    //session_start();
			    
			    $query = $_POST['rut2'];
			    $result = $db2 -> prepare($query);
			    $result -> execute();
			 
			    $result = $result -> fetchAll();
			    foreach ($result as $i) {
			    	echo "<tr> <td>$i[0]</td> <td>$i[1]</td> <td>$i[2]</td> <td>$i[3]</td> <td>$i[4]</td> <td>$i[5]</td> <td>$i[6]</td> <td>$i[7]</td></tr>";
			    }
			}
			?>
    </tbody>
  </table>
