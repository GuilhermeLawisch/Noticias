<?php
class Noticia {
    private $pdo;

    function __construct($dbname, $host, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $senha);
        } catch (Exception $e) {
            echo "Erro1: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro2: {$e->getMessage()}";
        }
    }
    function cadastrarNoticia($titulo, $categoria, $texto) {
        $cmd = $this->pdo->prepare("SELECT id FROM conteudo WHERE titulo = :t");
        $cmd->bindValue(":t", $titulo);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO conteudo(titulo, categoria, texto) VALUES (:t, :c, :txt)");
            $cmd->bindValue(":t", $titulo);
            $cmd->bindValue(":c", $categoria);
            $cmd->bindValue(":txt", $texto);
            $cmd->execute();
            return true;
        }
    }
    function cadastrarCategoria($categoria) {
        $cmd = $this->pdo->prepare("SELECT id_categoria FROM categoria WHERE categoria = :c");
        $cmd->bindValue(":c", $categoria);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO categoria(categoria) VALUES (:c)");
            $cmd->bindValue(":c", $categoria);
            $cmd->execute();
            return true;
        }
    }
    function buscarTitulo($pesquisa) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM conteudo WHERE titulo LIKE :p");
        $cmd->bindValue(":p", "%$pesquisa%");
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarNoticias() {
        $res = [];
        $cmd = $this->pdo->query("SELECT * FROM conteudo");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarCategorias() {
        $res = [];
        $cmd = $this->pdo->query("SELECT * FROM categoria"); 
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC); 
        return $res;
    }
    function buscarCategoriaId($id) {
        $cmd = $this->pdo->prepare("SELECT categoria FROM categoria WHERE id_categoria = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}

?>