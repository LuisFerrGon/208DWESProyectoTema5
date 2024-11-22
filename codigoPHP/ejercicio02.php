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
                 * @version 21/11/2024
                 */
                function verificarUsuarioContrasena($usu, $pass){
                    $existe=false;
                    $pass=$usu.$pass;
                    require_once '../core/confDBPDO.php';
                    try{
                        $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query=$conn->prepare("SELECT (T01_CodUsuario), (T01_Password) FROM T01_Usuario WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(:contrasena, 256);");
                        $query->bindParam(':usuario', $usu);
                        $query->bindParam(':contrasena', $pass);
                        $query->execute();
                        $existe=($query->fetchObject()!=null);
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
                    try{
                        //Se dan valor al usuario y contraseña
                        $usu=$_SERVER['PHP_AUTH_USER'];
                        $pass=$usu.$_SERVER['PHP_AUTH_PW'];
                        //Se hace una conexión para obtener los valores necesarios
                        $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $seleccion=$conn->prepare("SELECT (T01_DescUsuario), (T01_NumConexiones), (T01_FechaHoraUltimaConexion) FROM T01_Usuario WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(:contrasena, 256);");
                        $seleccion->bindParam(':usuario', $usu);
                        $seleccion->bindParam(':contrasena', $pass);
                        $seleccion->execute();
                        $resultSeleccion=$seleccion->fetchObject();
                        $descripcion=$resultSeleccion->T01_DescUsuario;
                        $conexiones=$resultSeleccion->T01_NumConexiones;
                        $fecha=$resultSeleccion->T01_FechaHoraUltimaConexion;
                        if($conexiones==0){
                            echo "<p>¡Bienvenido ".$descripcion."! Esta es la primera vez que te conectas desde la creación del usuario: ".date('d/m/Y H:i:s', strtotime($fecha))."</p>";
                        }else{
                            echo "<p>¡Bienvenido de nuevo ".$descripcion."! Esta es la ".$conexiones." vez que te conectas y te conectaste por última vez el ".date('d/m/Y H:i:s', strtotime($fecha))."</p>";
                        }
                        //Se actualiza las veces conectadas y la última fecha de conexión
                        $update=$conn->prepare("UPDATE T01_Usuario SET T01_NumConexiones=T01_NumConexiones+1, T01_FechaHoraUltimaConexion=NOW() WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(:contrasena, 256);");
                        $update->bindParam(':usuario', $usu);
                        $update->bindParam(':contrasena', $pass);
                        $update->execute();
                    }catch(PDOException $e) {
                        echo "Conexión fallida: " . $e->getMessage();
                    }finally {
                        unset($conn);
                    }
                }
            ?>
            <br><br>
        </main>
        <footer>
            <a href="../../index.php">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="../indexProyectoTema5.php">Tema 5</a>
            <a href="https://github.com/LuisFerrGon/208DWESProyectoTema5">GitHub</a>
            <p>Última versión: 21/11/2024</p>
        </footer>
    </body>
</html>