<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Consulta base de dato grupo impar </h1>

  <div class="container">
    <ul class="slider">
      <li id="consulta_1">
        <h3 align="center"> Mostrar nombre de todas las tiendas</h3>
        <h6 align="center"> Se mostrará junto con los nombre de las comunas que hace despacho</h6>

        <form align="center" action="consultas/consulta_1.php" method="post">
          <input class="submit" type="submit" value="Mostrar">
        </form>
      </li>



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
          <select name="Tipo">
           <option value="Comestible">Comestible</option> 
           <option value="NoComestible">No comestible</option> 
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
  
</body>
</html>
