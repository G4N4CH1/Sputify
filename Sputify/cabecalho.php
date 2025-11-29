<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicFlow</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #fafafa;
            font-family: "Inter", Arial, sans-serif;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #ff8fab, #b8c0ff);
            padding: 20px 40px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08);
        }

        header h1 {
            font-weight: 600;
            color: white;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background: #ffd6e0;
            padding: 30px 20px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.06);
            position: fixed;
            top: 0;
            left: 0;
           
        }

        body{
            padding-left: 230px;
        }

        .custom-btn {
            border: none;
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 500;
            letter-spacing: 0.3px;
            background: #ffd6e0;
            transition: 0.25s ease-in-out;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .custom-btn-2 {
            border: none;
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 500;
            letter-spacing: 0.3px;
            background: #ff8fab;
            transition: 0.25s ease-in-out;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0);
        }

        .custom-btn:hover {
            background: #ff8fab;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 138, 171, 0.4);
        }

        .album-card {
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            transition: .25s;
        }

        .album-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.09);
        }

        .album-card img {
            border-radius: 14px;
            width: 100%;
        }

        input {
            border-radius: 25px !important;
            padding: 12px 18px !important;
        }
    </style>
</head>

<body>
    <div>
        <div class="sidebar">
            <h2 class="custom-btn-2">Guia</h2>

            <nav class="nav flex-column">
                <a class="nav-link" href="listagemart.php">🎧 Artistas</a>
                <a class="nav-link" href="listagemMusica.php">📀 Musicas</a>
                <a class="nav-link" href="favoritaMusica">🎤 Musicas Favoritas</a>
                <a class="nav-link" href="favoritaArt">⭐ Artistas Favoritos</a>
                <a class="nav-link" href="listagemusu.php">💿 Usuarios</a>
            </nav>
        </div>
    </div>

    <header class="d-flex justify-content-between align-items-center">
        <a href="index.php" class="btn custom-btn-2"><h1>Sputify</h1></a>
       <?php if(!isset($_SESSION["email"])): ?>
    <div>
        <a href="formusu.php" class="btn custom-btn">Cadastrar</a>
        <a href="login.php" class="btn custom-btn">Entrar</a>
    </div>
<?php else: ?>
    <div>
        <a href="sair.php" class="btn custom-btn">Sair</a>
    </div>
<?php endif; ?>

        
        

    </header>


    <div class="container mt-5">

       

    </div>

</body>

</html>
