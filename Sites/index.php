<?php include('templates/header.html');  

<<<<<<< HEAD
session_start();
if (isset($_SESSION['rut'])){
	if(isset($_SESSION['jefe'])){
		include('templates/body_postlogin_jefe.html');
	} else {
		include('templates/body_postlogin.html');
	}	
} else {
	include('templates/body_prelogin.html');
}
?>

Home
=======
<body>
  <h1 align="center">Consulta base de datos. Grupo impar </h1>

  <div class="container">
    <ul class="slider">
      <li id="consulta_1">
        <h3 align="center"> Mostrar nombre de todas las tiendas</h3>
        <h6 align="center"> Se mostrará el nombre de cada tienda, junto con los nombres de las comunas a las que hace despacho</h6>
>>>>>>> c5647a5c27ac490a2cdbf19ff4a3ba7f6724e9af



    

<<<<<<< HEAD
    
=======
      <li id="consulta_2">
        <h3 align="center"> ¿Quieres buscar los jefes de tiendas de cierta comuna?</h3>

        <form align="center" action="consultas/consulta_2.php" method="post">
          Comuna:
          <input type="text" name="comuna">
          <br/><br/>
          <input class="submit" type="submit" value="Filtrar">
        </form>
      </li>

      <?php
      require("config/conexion.php");
      $result = $db -> prepare("SELECT DISTINCT Tipo FROM Productos;");
      $result -> execute();
      $dataCollected = $result -> fetchAll();
      ?>

      <li id="consulta_3">
        <h3 align="center"> ¿Buscas las tiendas que venden al menos un producto de cierta categoria?</h3>

        <form align="center" action="consultas/consulta_3.php" method="post">
          Selecciona un tipo:
          <select name="tipo">
            <?php
            foreach ($dataCollected as $d) {
              echo "<option value=$d[0]>$d[0]</option>";
            }
            ?>
          </select>
          <br/><br/>
          <input class="submit" type="submit" value="Mostrar">
        </form>
      </li>



      <li id="consulta_4">
        <h3 align="center"> Busca algun producto segun descripción</h3>

        <form align="center" action="consultas/consulta_4.php" method="post">
          Descripción:
          <input class="descripcion" type="text" name="descripcion">
          <br/><br/>
          <input class="submit" type="submit" value="Mostrar">
        </form>
      </li>



      <li id="consulta_5">
        <h3 align="center"> Mostrar edad promedio de cierta comuna</h3>

        <form align="center" action="consultas/consulta_5.php" method="post">
          Comuna:
          <input type="text" name="comuna">
          <br/><br/>
          <input class="submit" type="submit" value="Mostrar">
        </form>
      </li>



      <li id="consulta_6">
        <h3 align="center"> Mostrar tiendas con mayor cantidad de ventas del tipo de producto seleccionado</h3>

        <form align="center" action="consultas/consulta_6.php" method="post">
          Selecciona un tipo:
          <select name="tipo">
            <?php
            foreach ($dataCollected as $d) {
              echo "<option value=$d[0]>$d[0]</option>";
            }
            ?>
          </select>
          <br/><br/>
          <input class="submit" type="submit" value="Mostrar">
        </form>
      </li>
    </ul>
  </div>
  <div class="container1">
    <ul class="menu">
      <li>
        <a href="#consulta_1">consulta 1</a>
      </li>
      <li>
        <a href="#consulta_2">consulta 2</a>
      </li>
      <li>
        <a href="#consulta_3">consulta 3</a>
      </li>
      <li>
        <a href="#consulta_4">consulta 4</a>
      </li>
      <li>
        <a href="#consulta_5">consulta 5</a>
      </li>
      <li>
        <a href="#consulta_6">consulta 6</a>
      </li>
    </ul>
  </div>

>>>>>>> c5647a5c27ac490a2cdbf19ff4a3ba7f6724e9af
</body>
</html>