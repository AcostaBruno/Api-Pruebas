<?

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id'])){
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['nombre'] = $_POST['nombre'];


    }
} else {
    header('Location: index.php');
}

echo "Bienvenido ".$_SESSION['nombre'];
echo "<br>";
echo "<a href='cerrarSesion.php'>Cerrar sesion</a>";
echo "<br>";
echo $_POST['comentario'];