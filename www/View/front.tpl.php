<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CMS Restaurant</title>
    <meta name="description" content="Description de ma page">
    <link rel="stylesheet" type="text/css" href="/public/front.css">
    
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/richtext/jquery.richtext.min.js"></script>
    
    <script src="https://kit.fontawesome.com/f3633012bb.js" crossorigin="anonymous"></script>
    
    <?php $template = $this->data['selectedTemplate']; $navPages = $this->data['pages'];  ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo($template->getFont()); ?>" rel="stylesheet">

    <style>

        <?php 

            $array = explode('!!!!!', str_replace( ['?family=',':wght@', '&display'], '!!!!!', $template->getFont()));
            $font = str_replace(['+'], ' ' , $array[1]);
            
        ?>

        /* Default FONTS */

        * {
            font-family: "<?php echo($font); ?>";
        }


        #frontTemplate nav {
            background-color:#<?php echo($template->getColor()); ?>;
        }

        html, body {
            background-color:#<?php echo($template->getBackground()); ?>;
        }

    </style>

</head>

<body id="frontTemplate">
    <nav>
        <a href="/">Accueil</a>
        <a href="/catalogue">Catalogue</a>

        <?php foreach ($navPages as $navPage) { ?>
            <a href="/readpage/<?php echo($navPage->getSlug()) ?>"> <?php echo($navPage->getTitle()) ?> </a>
        <?php } ?>

        <a href='/shoppingCart'>Panier</a>
        <a href="/<?= isset($_SESSION['auth'])?'profile':'login'; ?> ">
            <?= isset($_SESSION['auth'])?'Profil':'Se Connecter'; ?>
        </a>
        <?php
            if(isset($_SESSION['auth'])){
        ?>
            <a href="/logout">Se Déconnecter</a>
        <?php
            } else {
        ?>
            <a href="/register"> S'inscrire </a>
        <?php } ?>
        </a>

        <?php if (isset($_SESSION['auth'])) { if($_SESSION['role'] === 'admin') { ?>
            <a href="/dashboard"> DASHBOARD </a>
        <?php } } ?>
    </nav>
    <div class="containerFront">

        <?php include "View/".$this->view.".view.php"; ?>

    </div>

</body>
</html>