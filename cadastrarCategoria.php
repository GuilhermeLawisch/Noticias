<?php
    require_once "layout.php";
    require_once "classeNoticia.php";
    require_once "conexao.php";
?>
    <section>
        <form action="" method="post">
            <div class="cadCategoria">
                <div>
                    <h2>Cadastrar Categoria</h2>
                </div>
                <div>
                    <input type="text" name="nCategoria" id="iCategoria" placeholder="Categoria">
                </div>
                <div class="cadastrar">
                    <input type="submit" value="Cadastrar">
                </div>
                <?php
                    if (isset($_POST['nCategoria'])) {
                        $categoria = addslashes($_POST['nCategoria']); 
                        if (!empty($categoria)) {
                            if ($n->cadastrarCategoria(ucfirst(strtolower($categoria)))) {
                                echo "<div class='verificacao'><span>Categoria cadastrada com sucesso!</span></div>";
                            } else {
                                echo "<div class='verificacao'><span>Essa categoria já existe!</span></div>";
                            }
                        }
                    }
                ?>
            </div>    
        </form>
    </section>
</body>
</html>