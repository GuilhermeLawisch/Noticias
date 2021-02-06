<?php
    require_once "layout.php";
    require_once "classeNoticia.php";

    $n = new Noticia("noticias", "localhost", "root", "");
?>

    <section>
        <form action="" method="post">
            <div class="cadNoticia">
                <div>
                    <h2>Cadastrar Notícia</h2>  
                </div>
                <div>
                    <input type="text" name="nTitulo" id="iTitulo" placeholder="Título">
                </div>
                <div>
                    <select name="nCategoria" id="iCategoria">
                        <?php
                            $dados = $n->buscarCategorias();
                            $quantidadeDados = count($dados);
                            for ($i = 0; $i < $quantidadeDados; $i++) {
                                foreach ($dados[$i] as $k => $v) {
                                    if ($k == "id_categoria") {
                                        echo "<option value='{$v}'>";
                                    } else if ($k == "categoria") {
                                        echo "{$v}</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <textarea name="nConteudo" id="iConteudo" cols="30" rows="10" placeholder="Conteúdo"></textarea>
                </div>
                <div class="cadastrar">
                    <input type="submit" value="Cadastrar">
                </div>
                <?php
                    if (isset($_POST['nTitulo'])) {
                        $titulo = addslashes($_POST['nTitulo']);
                        $categoria = addslashes($_POST['nCategoria']);
                        $conteudo = addslashes($_POST['nConteudo']);
                        if (!empty($titulo) && !empty($categoria) && !empty($conteudo)) {
                            if ($n->cadastrarNoticia($titulo, $categoria, $conteudo)) {
                                echo "<div class='verificacao'><span>Noticia cadastrada com sucesso!</span></div>";
                            } else {
                                echo "<div class='verificacao'><span>Esse titulo já existe!</span></div>";
                            }
                        }
                    }
                ?>
            </div>
        </form>
    </section>
</body>
</html>