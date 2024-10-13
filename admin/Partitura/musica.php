<?php 
include '../../scripts/conexao.php';


$nome = $_POST['nome_musica'];
$author = $_POST['author'];
$genero = $_POST['gen'];
$Idinstrumento = $_POST['instrumento'];
$iframe = $_POST['iframe'];

$sql = "SELECT * from instrumento where id = $Idinstrumento";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);
$instrumento = $linha['nome'];


// Verifica se os arquivos foram enviados
if (isset($_FILES['playback']) && isset($_FILES['part1']) && isset($_FILES['part2']) && isset($_FILES['part3'])) {
    
    $filePB = $_FILES['playback'];
    $filePDF = $_FILES['part1'];
    $filePNG = $_FILES['part2'];
    $fileMSC = $_FILES['part3'];

    $PBName = $filePB['name'];
    $PDFName = $filePDF['name'];
    $PNGName = $filePNG['name'];
    $MSCName = $fileMSC['name'];
    
    $PBtmp = $filePB['tmp_name'];
    $PDFtmp = $filePDF['tmp_name'];
    $PNGtmp = $filePNG['tmp_name'];
    $MSCtmp = $fileMSC['tmp_name'];

    // Definindo o caminho de destino
    $path = "partituras/$nome/";

    // Criando a Pasta
    if (!is_dir("../../".$path)) {
        mkdir("../../".$path, 0777, true);
    }

    // Definindo os caminhos de cada um
    $pathPb = "../../".$path . $PBName;
    $pathPDF = "../../".$path . $PDFName;
    $pathPNG = "../../".$path . $PNGName;
    $pathMSC = "../../".$path . $MSCName;

    // Movendo os arquivos
    if (move_uploaded_file($PDFtmp, $pathPDF) && move_uploaded_file($PNGtmp, $pathPNG) && move_uploaded_file($MSCtmp, $pathMSC) && move_uploaded_file($PBtmp, $pathPb)) {

        echo "arquivos movidos!";

        $sql = "INSERT INTO música (nome, autor_fid, genero_fid, path_playback, path_pdf, path_png, path_msc, iframe, Idinstrumento, instrumento) VALUES ('$nome','$author','$genero','$path$PBName','$path$PDFName','$path$PNGName','$path$MSCName','$iframe','$Idinstrumento', '$instrumento')";
        if (mysqli_query($conn,$sql)) {
            echo "arquivo salvo!";
            header("Location: criarMusica.php");
        } else {
            echo "Erro em salvar no BD!";
        };

    }
}

?>