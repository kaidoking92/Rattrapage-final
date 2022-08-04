<h1> Sélectionnez une catégorie </h1>

<div class="categoriesList">

<?php foreach ($categories as $category): ?>
    <a href="/category/<?= $category->getId(); ?>">
        <div class="categoryBlock">
            <i class="fa-solid fa-cubes" style="color:#<?= $category->getColor(); ?>;"></i>
            <h3 style="color:#<?= $category->getColor(); ?>;"> <?= $category->getName(); ?> </h3>
        </div>
    </a>
<?php endforeach; ?>

</div>