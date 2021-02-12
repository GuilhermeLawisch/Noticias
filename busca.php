<?php
    require_once "classeNoticia.php";
    require_once "layout.php";
    require_once "conexao.php";

    $noRepeat = [];
    $testeDeRepeticoes = 0;
    if (isset($_GET['nBusca']) && !empty($_GET['nBusca'])) {
        echo "<section>";
        $pesquisa = addslashes($_GET['nBusca']);        // BUSCA POR CATEGORIA
        $dadosCategoria = $n->buscarCategoriaCategoria($pesquisa);
        if ($dadosCategoria != false) {
            for ($i=0; $i < count($dadosCategoria); $i++) { 
                foreach ($dadosCategoria[$i] as $key => $value) {
                    if ($key == "id_categoria") {
                        $dados3 = $n->buscarNoticiaCategoria($value);
                        $numeroDados3 = count($dados3);
                        for ($j=0; $j < $numeroDados3; $j++) { 
                            echo "<div class='caixaNoticia'>";
                            foreach ($dados3[$j] as $key => $value) {
                                if ($key == "titulo") {
                                    echo "<h1>$value</h1>";
                                } else if ($key == "categoria") {
                                    $categoria = $n->buscarCategoriaId($value);
                                    echo "<p>". $categoria["categoria"]. "</p>";
                                } else if ($key == "id") {
                                    $noRepeat[] = $value;       
                                    echo "<a href='visualizacao.php?idVisualizar={$value}'>Acessar</a>";
                                }
                            }
                            echo "</div>";
                        }
                    }
                }
            }
        } else {
            $vazio = 1;
        }
        $dados3 = $n->buscarNoticiasTitulo($pesquisa);  // BUSCA POR TITULO
        if ($dados3 != false) {
            $numeroDados3 = count($dados3);
            for ($j=0; $j < $numeroDados3; $j++) { 
                foreach ($dados3[$j] as $key => $value) {
                    if ($key == "id") {
                        $testeVazio = [];
                        if ($noRepeat != $testeVazio) {
                            $repetidos = count($noRepeat);
                            for ($l=0; $l < $repetidos; $l++) { 
                                if ($key == $noRepeat[$l]) {
                                    $testeDeRepeticoes++;
                                }
                            }
                            if ($testeDeRepeticoes == $repetidos) {
                                echo "<div class='caixaNoticia'>";
                                foreach ($dados3[$j] as $chave => $valor) {
                                    if ($chave == "titulo") {
                                        echo "<h1>$valor</h1>";
                                    } else if ($chave == "categoria") {
                                        $categoria = $n->buscarCategoriaId($valor);
                                        echo "<h2>". $categoria["categoria"]. "</h2>";
                                    } else if ($chave == "id") {
                                        echo "<a href='visualizacao.php?idVisualizar={$valor}'>Acessar</a>";
                                    }
                                }
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='caixaNoticia'>";
                            foreach ($dados3[$j] as $chave => $valor) {
                                if ($chave == "titulo") {
                                    echo "<h1>$valor</h1>";
                                } else if ($chave == "categoria") {
                                    $categoria = $n->buscarCategoriaId($valor);
                                    echo "<h2>". $categoria["categoria"]. "</h2>";
                                } else if ($chave == "id") {
                                    echo "<a href='visualizacao.php?idVisualizar={$valor}'>Acessar</a>";
                                }
                            }
                            echo "</div>";
                        }
                    }
                }
            }
        } else {
            if ($vazio == 1) {
                echo "<h3>Nenhuma notícia encontrada.<h3>";
            }
        }
        echo "</section>";
    } 
?>