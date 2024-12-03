<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $modelo = $_POST['modelo'];

    if (isset($_POST['add'])) {
        $query = "INSERT INTO coches (matricula, precio, color, modelo) VALUES ('$matricula', '$precio', '$color', '$modelo')";
        $conn->query($query);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM coches WHERE id=$id";
        $conn->query($query);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $query = "UPDATE coches SET matricula='$matricula', precio='$precio', color='$color', modelo='$modelo' WHERE id=$id";
        $conn->query($query);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Gestión de Coches</title>
</head>
<body>
    <h2>Gestión de Coches</h2>
    <form method="POST" action="">
        <input type="text" name="matricula" placeholder="Matrícula" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <button type="submit" name="add">Agregar</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Matrícula</th>
            <th>Precio</th>
            <th>Color</th>
            <th>Modelo</th>
            <th>Acciones</th>
        </tr>
        <?php
        $query = "SELECT * FROM coches";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <form method='POST' action=''>
                    <td>{$row['id']}<input type='hidden' name='id' value='{$row['id']}'></td>
                    <td><input type='text' name='matricula' value='{$row['matricula']}'></td>
                    <td><input type='number' step='0.01' name='precio' value='{$row['precio']}'></td>
                    <td><input type='text' name='color' value='{$row['color']}'></td>
                    <td><input type='text' name='modelo' value='{$row['modelo']}'></td>
                    <td>
                        <button type='submit' name='edit'>Editar</button>
                        <button type='submit' name='delete'>Eliminar</button>
                    </td>
                </form>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
