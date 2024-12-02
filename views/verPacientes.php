<?php require 'templates/header.php'; ?>

    
<a class="container-imaA" href="vistaMedicos">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class="form-group">
        <form method="GET" action="">
            <label for="search">Buscar por cédula:</label>
            <input type="text" id="search" name="search" placeholder="Ingrese número de cédula">
            <button type="submit" class="btn">Buscar</button>
        </form>
    </div>

    <!-- Tabla de pacientes -->
    <table>
        <thead>
            <tr>
                <th>Nombre del Paciente</th>
                <th>Cédula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $conn = new mysqli("localhost", "root", "", "tu_base_de_datos");

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Obtener el parámetro de búsqueda
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            // Consultar los pacientes
            $sql = "SELECT nombre, cedula FROM pacientes";
            if (!empty($search)) {
                $sql .= " WHERE cedula LIKE '%$search%'";
            }
            $result = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cedula']) . "</td>";
                    echo "<td><button class='btn'>Diagnóstico</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>

<?php require 'templates/footer.php'; ?>