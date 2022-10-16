<!DOCTYPE html>
<html lang="es">
<head>
    <title>Laboratorio 9.2</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>Consulta de noticias</h1>

    <form name="FormFiltro" method="post" action="lab92.php">
    <br>
    Filtrar por: <select name="campos" id="">
        <option value="texto" selected>Descripcion</option>
        <option value="titulo">Titulo</option>
        <option value="categoria">Categoria</option>
    </select>
    con el valor
    <input type="text" name="valor">
    <input type="submit" name="ConsultarFiltro" value="Filtrar Datos">
    <input type="submit" name="ConsultarTodos" value="Ver todos">

    </form>

    <?php

    require_once("class/noticias.php");
    $obj_noticia = new noticia();
    $noticias = $obj_noticia->consultar_noticias();

    if(array_key_exists('ConsultarTodos', $_POST)) {
        $obj_noticia = new noticia();
        $noticias_new = $obj_noticia->consultar_noticias();
    }

    if(array_key_exists('ConsultarFiltro', $_POST)) {
        $obj_noticia = new noticia();
        $noticias = $obj_noticia->consultar_noticias_filtro($_REQUEST['campos'], $_REQUEST['valor']);
    }

    $nfilas = count($noticias);

    if($nfilas > 0) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>Titulo</th>\n");
        print("<th>Texto</th>\n");
        print("<th>Categoria</th>\n");
        print("<th>Fecha</th>\n");
        print("<th>Imagen</th>\n");
        print("</tr>\n");

        foreach($noticias as $resultado) {
            print("<tr>\n");
            print("<td>" . $resultado['titulo'] . "</td>\n");
            print("<td>" . $resultado['texto'] . "</td>\n");
            print("<td>" . $resultado['categoria'] . "</td>\n");
            print("<td>" . date("j/n/Y",strtotime($resultado['fecha'])) . "</td>\n");

            if($resultado['imagen'] != "") {
                print("<td><a target='_blank' href='img/".$resultado['imagen']."'><img border='0' src='img/iconotexto.gif'></a></td>\n");
            } else {
                print("<td>&nbsp;</td>\n");
            }
            
            print("</tr>\n");
        }
        print("</table>\n");

    } else {
        print("No hay noticias disponibles");
    }

    ?>
</body>
</html>