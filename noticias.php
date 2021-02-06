<?php
    require_once "layout.php";
    require_once "classeNoticia.php";

    $n = new Noticia("noticias", "localhost", "root", "");
?>
    <section>
        <?php
            if (isset($_GET['nBusca'])) {
                $pesquisa = addslashes($_GET['nBusca']);
                if (!empty($pesquisa)) {
                    $dados = $n->buscarTitulo($pesquisa);
                    echo "<div class='caixaNoticia'>";
                    foreach ($dados as $chave => $valor) {
                        if ($chave == "titulo") {
                            echo "<h1>$valor</h1>";
                        } else if ($chave == "categoria") {
                            $categoria = $n->buscarCategoriaId($valor);
                            echo "<h2>". $categoria["categoria"]. "</h2>";
                        } else if ($chave == "texto") {
                            echo "<p>$valor</p>";
                        }
                    }
                    echo "</div>";
                }
            } else {
                $dados = $n->buscarNoticias();
                $numeroDeNoticias = count($dados);
                if ($numeroDeNoticias > 0) {
                    for ($i = 0; $i < $numeroDeNoticias; $i++) {
                        echo "<div class='caixaNoticia'>";
                        foreach ($dados[$i] as $chave => $valor) {
                            if ($chave == "titulo") {
                                echo "<h1>$valor</h1>";
                            } else if ($chave == "categoria") {
                                $categoria = $n->buscarCategoriaId($valor);
                                echo "<h2>". $categoria["categoria"]. "</h2>";
                            } else if ($chave == "texto") {
                                echo "<p>$valor</p>";
                            }
                        }
                        echo "</div>";
                    }
                }   
            }
        ?>
    </section>
</body>
</html>