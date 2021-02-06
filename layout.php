<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Notícias</title>
</head>
<body>
    <header>
        <div class="cabecalho">
            <div class="esquerda">
                <a href="noticias.php">Logo</a>
            </div>
            <div class="direita">
                <a href="cadastrarCategoria.php">CADASTRAR CATEGORIA</a>
                <a href="cadastrarNoticia.php">CADASTRAR NOTÍCIA</a>
                <form action="noticias.php" method="get">
                    <input type="text" name="nBusca" id="iBusca">
                    <input type="submit" value="Buscar">
                </form>
            </div>
        </div>
    </header>