<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo (isset($title)) ? $title : ''; ?>Classificados</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="Recriação do projeto classificados do bonieky em mvc">
        <meta name="author" content="Rafael Jeferson">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/style.css" />
    </head>
    <body>
    	<!-- start navbar -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="<?php echo BASE_URL;?>">Classificados</a>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?> 
                <!-- Navbar text-->
                <span class="navbar-text">Óla, Rafael</span>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>anuncios">Meus Anúncios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>login/sair">Sair</a>
                </li>
                <?php else: ?>
                <li class="nav-item <?php  ?>">
                    <a class="nav-link" href="<?php echo BASE_URL;?>register">Cadastre-se</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>login">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>

		<!-- end .\ navbar -->
        <?php $this->loadView($viewName, $viewData); ?>

        <!-- script here -->
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script.js"></script>
    </body>
</html>