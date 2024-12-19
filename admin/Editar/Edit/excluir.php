<?php 
    include "../../../scripts/conexao.php";

    $id = $_GET['id'];
    $func = $_GET['func'];

    if ($func == 1 & isset($_POST['ex'])) {
        
        $sql = "Select * from musica where genero_fid=$id";
        $res = mysqli_query($conn,$sql);

        while ($linha = mysqli_fetch_array($res)) {
            excluirMusica($linha['id'],$conn);
        }
        
        $sql = "DELETE from Genero where id=$id";
        mysqli_query($conn,$sql);
        header("Location: ../../Painel");

    }
    if ($func == 2 & isset($_POST['ex'])) {
        $sql = "Select * from musica where autor_fid=$id";
        $res = mysqli_query($conn,$sql);

        while ($linha = mysqli_fetch_array($res)) {
            excluirMusica($linha['id'],$conn);
        }

        $sql = "SELECT * from autor where id=$id";
        $res = mysqli_query($conn,$sql);
        $linha = mysqli_fetch_array($res);

        unlink("../../../".$linha['path_foto']);
        rmdir("../../../".$linha['path']);

        $sql = "DELETE from Autor where id=$id";
        mysqli_query($conn,$sql);
        header("Location: ../../Painel");

    }
    if ($func == 3 & isset($_POST['ex'])) {
        excluirMusica($id,$conn);
        header("Location: ../../Painel");
    }

    function excluirMusica($ID, $conn) {
        $sql = "SELECT musica.nome, instrumento.nome as instrumento, musica.path_pdf, musica.path_png, musica.path_msc, musica.path_mp3 from musica join instrumento on instrumento.id = musica.IdInstrumento where musica.id=$ID";
        $res = mysqli_query($conn,$sql);
        $linha = mysqli_fetch_array($res);

        $nome = $linha['nome'];
        $instrumento = $linha['instrumento'];
        $pathRaiz = "partituras/$instrumento/$nome";

        unlink("../../../".$linha['path_pdf']);
        unlink("../../../".$linha['path_png']);
        unlink("../../../".$linha['path_msc']);
        unlink("../../../".$linha['path_mp3']);
        
        rmdir("../../../$pathRaiz");

        $sql = "DELETE from musica where id=$ID";
        mysqli_query($conn,$sql);
    }
    if ($func == 4 & isset($_POST['ex'])) {
        
        $sql = "Select * from musica where idinstrumento=$id";
        $res = mysqli_query($conn,$sql);

        while ($linha = mysqli_fetch_array($res)) {
            excluirMusica($linha['id'],$conn);
        }
        
        $sql = "DELETE from instrumento where id=$id";
        mysqli_query($conn,$sql);
        header("Location: ../../Painel");

    }

    if ($func == 5 & isset($_POST['ex'])) {

        $sql = "DELETE from admin where id=$id";
        mysqli_query($conn,$sql);
        header("Location: ../../Painel");

    }



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Excluir</h1>
    </header>
    <main>
        <form action="#" method="post">
            <p>Deseja Realmente Excluir? <br> essa ação é <strong>irreversivel!</strong></p>
            <div class="btns">
                <input type="submit" name="ex" value="Excluir" class="btn-excluir">
                <input type="button" value="Cancelar" onclick="javascript:location.href = '../../Painel'">
            </div>
        </form>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>