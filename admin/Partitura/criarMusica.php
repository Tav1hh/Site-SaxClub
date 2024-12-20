<?php 
include '../../scripts/conexao.php';
//Testa se está logado
if (isset($_SESSION['id']) & isset($_SESSION['nome'])) {
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where id = '$id' and nome = '$nome'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario == null) {
        session_unset();
        session_destroy();
        header('Location: ../../x039.php');
    }
} else { 
    session_unset();
    session_destroy();
    header('Location: ../../x039.php');
}

// Pega os dados do DB
$sql = "SELECT * from genero order by nome";
$resGen = mysqli_query($conn,$sql);

$sql = "SELECT * from autor order by nome";
$resautor = mysqli_query($conn,$sql);

$sql = "SELECT * from instrumento order by nome";
$resinstrumento = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Música</title>
    <link rel="stylesheet" href="enviar.css">
</head>
<body>
    <nav id="sidebar">
        <button onclick="togglebar()"></button>
        <h2>Painel</h2>
        <a href="../Painel/index.php">Dashboard</a>
        <a href="../Partitura/criarMusica.php">Cadastrar Partitura</a>
        <a href="../Cadastro/cadastrar.php">Cadastrar Adm</a>
        <a href="../../">Home</a>
        <a href="../deslogar.php">Logout</a>
    </nav>
    <section class="menu">
        <button onclick="togglebar()"></button>
         <a href="criarGenero.php">Genero</a>
        <a href="criarAutor.php">Autor</a>
        <a href="criarInstrumento.php">Instrumento</a>
        <a href="criarMusica.php">Música</a>
    </section>
    <header>
        <h1>Cadastro de Música</h1>
    </header>
    <main>
            <form action="musica.php" method="post" enctype="multipart/form-data">
                <section class="classificacoes">
                    <div>
                        <label for="inome_musica">Nome:</label>
                        <input type="text" name="nome_musica" id="inomemusica" placeholder="Nome da Música" required>
                    </div>
                    <div>
                        <label for="Iautor">autor:</label>
                        <select name="autor" id="Iautor" required>
                        <?php 
                            while ($linha = mysqli_fetch_array($resautor)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="Igen">Genero:</label>
                        <select name="gen" id="Igen" required>
                            <?php 
                            while ($linha = mysqli_fetch_array($resGen)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="instrumento">Instrumento:</label>
                        <select name="instrumento" id="Instrumento" required>
                            <?php 
                               while ($linha = mysqli_fetch_array($resinstrumento)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="iframe">Iframe:</label>
                        <input type="text" name="iframe" id="iframe" placeholder="Video para incorporar">
                    </div>
                </section>

                <section class="arquivos">
                    <div>
                        <label for="ipart2" id="ilabel2" onclick="addEventListener('change',selecionou('ipart2','ilabel2'))">Capa - PNG</label>
                        <input type="file" name="part2" id="ipart2" required>
                    </div>

                    <div>
                        <label for="ipart1" id="ilabel1" onclick="addEventListener('change',selecionou('ipart1','ilabel1'))">Partitura - PDF</label>
                        <input type="file" name="part1" id="ipart1" required>
                    </div>


                    <div>
                        <label for="ipart3" id="ilabel3" onclick="addEventListener('change',selecionou('ipart3','ilabel3'))">Partitura - MSC</label>
                        <input type="file" name="part3" id="ipart3" required>
                    </div>


                    <div>
                        <label for="ipart4" id="ilabel4" onclick="addEventListener('change',selecionou('ipart4','ilabel4'))">PlayBack</label>
                        <input type="file" name="part4" id="ipart4">
                    </div>
                </section>

                <div class="btns">
                    <input type="submit">
                </div>

            </form>

        </form>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>

    <script>

        function selecionou(ipart,ilabel) {

            const fileInput = document.getElementById(ipart);
            const fileLabel = document.getElementById(ilabel);
            
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileLabel.style.backgroundColor = 'green';
                    fileLabel.textContent = `Arquivo selecionado: ${fileInput.files[0].name}`;
                } else {
                    fileLabel.style.backgroundColor = '#333';
                    fileLabel.textContent = 'Escolher arquivo';
                }
            })
        }
        function togglebar() {
            const sidebar = document.getElementById('sidebar')
            sidebar.classList.toggle('activate');
        }

    </script>
</body>
</html>