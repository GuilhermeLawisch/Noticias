<?php
    require_once "layout.html";
    require_once "classeNoticia.php";
    require_once "conexao.php";

    if (isset($_GET['idEditar']) && !empty($_GET['idEditar'])) {
        $idNoticia = addslashes($_GET['idEditar']);
        $res = $n->buscarNoticiasId($idNoticia);
    } 
?>
    <section class="cad">
        <div class="cadNoticia">
            <form action="" method="post" class="formCad">
                <div class="cadastrar">
                    <h2>Cadastrar Notícia</h2>  
                </div>
                <div class="cadastrar">
                    <input type="text" name="nTitulo" id="iTitulo" placeholder="Título" value="<?php if (isset($res)) {echo $res['titulo'];}?>">
                </div>
                <div class="cadastrar">
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
                <div class="cadastrar">
                    <textarea name="nConteudo" id="iConteudo" cols="30" rows="10" placeholder="Conteúdo"><?php if (isset($res)) {echo $res['texto'];}?></textarea>
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
                            if (isset($_GET['idEditar']) && !empty($_GET['idEditar'])) {
                                $id = $_GET['idEditar'];
                                if ($n->AtualizarNoticia($id, $titulo, $categoria, $conteudo)) {
                                    echo "<div class='verificacao'><span>Noticia atualizada com sucesso!</span></div>";
                                    header("location: cadastrarNoticia.php");
                                }
                            } else {
                                if ($n->cadastrarNoticia($titulo, $categoria, $conteudo)) {
                                    echo "<div class='verificacao'><span>Noticia cadastrada com sucesso!</span></div>";
                                } else {
                                    echo "<div class='verificacao'><span>Esse titulo já existe!</span></div>";
                                }
                            } 
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>