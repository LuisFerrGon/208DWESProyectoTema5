<!DOCTYPE html>
<!--Autor: Luis Ferreras González-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Luis Ferreras</title>
        <link rel="stylesheet" type="text/css" href="../webroot/estilosEjercicios.css">
    </head>
    <body>
        <header>
            <h1>Ejercicio 02</h1>
        </header>
        <main>
            <?php
                /**
                 * @author Luis Ferreras González
                 * @version 20/11/2024
                 */
                function verificarUsuarioContrasena($usu, $pass){
                    $existe=false;
                    require_once '../core/confDBPDO.php';
                    try{
                        $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query=$conn->prepare("SELECT (T01_CodUsuario, T01_Password) FROM T01_Usuario WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(CONCAT(:usuario, :contrasena), 256);");
                        $query->bindParam(':usuario', $usu);
                        $query->bindParam(':contrasena', $pass);
                        $query->execute();
                        $existe=($query!=null);
                    }catch(PDOException $e) {
                        echo "Conexión fallida: " . $e->getMessage();
                    }finally {
                        unset($conn);
                    }
                    return $existe;
                };
                //Si el usuario no es 'admin' o la contraseña no es 'paso', pedimos las credenciales.
                if ((!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW'])) || !verificarUsuarioContrasena($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])){
                    // Si no hay autenticación o las credenciales no son correctas
                    header('WWW-Authenticate: Basic Realm="Mi dominio"');
                    // Código por sino esta autenticado
                    header('HTTP/1.0 401 Unauthorized');
                    echo("<p style='color: red;'><b>Error en la Autenticación</b></p><br>");
                    echo('<button><a href="/208DWESProyectoTema5" style="text-decoration: none;">Volver</a></button>');
                    exit(); // Detiene la ejecución si es incorrecta
                }else{
                    // Si la autenticación fue correcta, mostramos los datos del usuario
                    echo "<p style='color: green;'><b>Sesión iniciada correctamente</b></p>";
                    // Muestra el nombre de usuario
                    echo "<p>Nombre de usuario: <b>" . $_SERVER['PHP_AUTH_USER'] . "</b></p>";
                    // Muestra la contraseña
                    echo "<p>Password: <b>" . $_SERVER['PHP_AUTH_PW'] . "</b></p>";
                }
            ?>
            <br><br>
        </main>
        <footer>
            <a href="../../index.php">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="../indexProyectoTema5.php">Tema 5</a>
            <a href="https://github.com/LuisFerrGon/208DWESProyectoTema5">GitHub</a>
        </footer>
    </body>
</html>