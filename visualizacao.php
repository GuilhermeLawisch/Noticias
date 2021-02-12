<?php
    require_once "classeNoticia.php";
    require_once "layout.php";
    require_once "conexao.php";

    if (isset($_GET['idVisualizar']) && !empty($_GET['idVisualizar'])) {
        $idNoticia = addslashes($_GET['idVisualizar']);
        $noticia = $n->buscarNoticiasId($idNoticia);
        echo "<div class='visualizar'>";
        foreach ($noticia as $key => $value) {
            if ($key == "titulo") {
                echo "<h1>$value</h1>";
            } else if ($key == "categoria") {
                $categoria = $n->buscarCategoriaId($value);
                echo "<h2>". $categoria["categoria"]. "</h2>";
            } else if ($key == "texto") {
                echo "<p>$value</p>";
            } else if ($key == "id") {
                echo "<a href='cadastrarNoticia.php?idEditar={$value}'>Editar</a>";
            }
        }
        echo "</div>";
    }
?>

