<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title> Templates </title>
        <meta name="description" content="Description de ma page">
    </head>
    <body>
        <h1 class="title">Templates</h1>
        <a href="/template-register">Ajouter un template</a>
        <ul>
            <?php foreach ($templates as $template): ?>
                <li>
                    <span style="color: #<?= $template->getColor() ?>"> <?= $template->getName(); ?> </span>
                    <?php if($template->getActive()) { ?>
                        <span style="color:green"> Activé </span>
                    <?php } else { ?>
                        <span style="color:red"> Désactivé </span>
                    <?php } ?>

                    <a href="/template/<?= $template->getId(); ?>"><button>Modifier</button></a>

                    <?php if(!$template->getActive()) { ?>
                        <a href="/template-update/<?php echo $template->getId(); ?>"><button>Activer le template</button></a>
                    <?php } ?>

                    <div id="delete" style="display: inline-block;">
                        <?php $this->includePartial("form", $template->getRemoveTemplateForm()) ?> 
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if($pages > 1){
        ?>
            <nav>
                <ul class="pagination">
                    <?php
                    if($currentPage != 1){
                    ?>
                        <li><a href="/templates?page=<?= $currentPage - 1 ?>">Précédent</a></li>
                    <?php
                    }
                    for($i = 1;$i<=$pages;$i++):
                    ?>
                        <li><a href="./templates?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    endfor;
                    if($currentPage != $pages){
                    ?>
                        <li><a href="./templates?page=<?= $currentPage + 1 ?>">Suivant</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        <?php
        }
        ?>
</html>