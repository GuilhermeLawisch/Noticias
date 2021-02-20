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
            $cmd = $this->pdo->prepare("INSERT INTO conteudo(titulo, categoria, texto, data_envio) VALUES (:t, :c, :txt, NOW())");
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
    function atualizarNoticia($id, $titulo, $categoria, $texto) {
        $cmd = $this->pdo->prepare("UPDATE conteudo SET titulo = :t, categoria = :c, texto = :txt, data_envio = NOW() WHERE id = :id");
        $cmd->bindValue(":t", $titulo);
        $cmd->bindValue(":c", $categoria);
        $cmd->bindValue(":txt", $texto);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return true;
    }
    function buscarNoticias() {
        $res = [];
        $cmd = $this->pdo->query("SELECT * FROM conteudo ORDER BY data_envio DESC");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    function buscarNoticiasId($id) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM conteudo WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarNoticiasTitulo($titulo) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM conteudo WHERE titulo LIKE :p ORDER BY data_envio DESC");
        $cmd->bindValue(":p", "%$titulo%");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarNoticiaCategoria($categoria) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM conteudo WHERE categoria = :c ORDER BY data_envio DESC");
        $cmd->bindValue(":c", $categoria);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarNoticiaTituloCategoria($pesquisaTitulo, $pesquisaCategoria) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM conteudo WHERE titulo LIKE :t OR categoria = :c");
        $cmd->bindValue(":t", "%$pesquisaTitulo%");
        $cmd->bindValue(":c", $pesquisaCategoria);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarCategorias() {
        $res = [];
        $cmd = $this->pdo->query("SELECT * FROM categoria"); 
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC); 
        return $res;
    }
    function buscarCategoriaCategoria($categoria) {
        $res = false;
        $cmd = $this->pdo->prepare("SELECT id_categoria FROM categoria WHERE categoria LIKE :c");
        $cmd->bindValue(":c", "%$categoria%");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function buscarCategoriaId($id) {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT categoria FROM categoria WHERE id_categoria = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}

?>