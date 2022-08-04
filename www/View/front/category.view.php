<h1> Sélectionnez un produit </h1>

<div class="productsList">

<?php foreach ($products as $product): ?>
    <a href="/pageProduct/<?= $product->getId(); ?>">
        <div class="productBlock">
            <img src="/public/img/product/<?= $product->getPicture(); ?>" alt="<?= $product->getName(); ?>"> 
            <div class="productBlockInfos">
                <h3> <?= $product->getName(); ?> </h3>
                <p> <?= $product->getPrice(); ?>€/u </p>
                <p style="color:<?= $product->getStock() >= 1 ?'green':'red'; ?>;"  > <?= $product->getStock(); ?> en stock </p>
            </div>
        </div>
    </a>
<?php endforeach; ?>

</div>
