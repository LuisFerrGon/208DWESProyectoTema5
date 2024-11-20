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
            <h1>Ejercicio 00</h1>
        </header>
        <main>
            <?php
                /**
                 * @author Luis Ferreras Gonzalez
                 * @version 20/11/2024
                 */
                function mostrarSuperglobal($nombre, $variable){
                    if(!empty($variable)){
                        echo "<h2>$nombre</h2>";
                        foreach($variable as $key=>$value){
                            print_r($key."=>".$value."<br>");
                        }
                    }
                };
                mostrarSuperglobal('$_SERVER', $_SERVER);
                mostrarSuperglobal('$_REQUEST', $_REQUEST);
                mostrarSuperglobal('$_GET', $_GET);
                mostrarSuperglobal('$_POST', $_POST);
                mostrarSuperglobal('$_COOKIE', $_COOKIE);
                mostrarSuperglobal('$_ENV', $_ENV);
                mostrarSuperglobal('$_FILES', $_FILES);
                if(isset($_SESSION)){
                    mostrarSuperglobal('$_SESSION', $_SESSION);
                }
                phpinfo();
            ?>
            <div style='height: 30px'></div>
        </main>
        <footer>
            <a href="../../index.php">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="../indexProyectoTema5.php">Tema 5</a>
            <a href="https://github.com/LuisFerrGon/208DWESProyectoTema5">GitHub</a>
        </footer>
    </body>
</html>