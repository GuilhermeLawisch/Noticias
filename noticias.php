<?php
    require_once "layout.php";
    require_once "classeNoticia.php";
    require_once "conexao.php";
?>
    <section> 
        <?php  
            $dados = $n->buscarNoticias();      // FEED NOTÍCIAS
            $numeroDeNoticias = count($dados);
            if ($numeroDeNoticias > 0) {
                for ($i = 0; $i < $numeroDeNoticias; $i++) {
                    echo "<div class='caixaNoticia'>";
                    foreach ($dados[$i] as $chave => $valor) {
                        if ($chave == "titulo") {
                            echo "<h1>$valor</h1>";
                        } else if ($chave == "categoria") {
                            $categoria = $n->buscarCategoriaId($valor);
                            echo "<p class='categoria'>". $categoria["categoria"]. "</p>";
                        } else if ($chave == "id") {
                            echo "<a href='visualizacao.php?idVisualizar={$valor}'>Acessar</a>";
                        }
                    }
                    echo "</div>";
                }
            }   
        ?>
    </section>
</body>
</html>