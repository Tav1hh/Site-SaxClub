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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Adm</title>
    <link rel="stylesheet" href="style.css">
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
    <header>
        <button onclick="togglebar()"></button>
        <h1>Registrar ADM</h1>
    </header>
    <main>
            <form action="cadastro.php" method="post">
                    <section class="classificacoes">
                        <div>
                            <label for="iadm_nome">Nome:</label>
                            <input type="text" name="adm_nome" id="iadm_nome" placeholder="Nome do ADM">
                        </div>
                        <div>
                            <label for="iadm_login">Login:</label>
                            <input type="text" name="adm_login" id="iadm_login" placeholder="Login do ADM">
                        </div>
                        <div>
                            <label for="iadm_senha">Senha:</label>
                            <input type="text" name="adm_senha" id="iadm_senha" placeholder="Senha do ADM">
                        </div>

                    </section>
                    <div class="btns">
                        <input type="submit" value="Registrar">
                    </div>
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