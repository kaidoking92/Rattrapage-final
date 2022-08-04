<ul>
    <?php foreach($products as $key => $product): ?>
    <?php if($key == 'quantity') { continue; } ?>
     <li> <?=$product->getName() ?> => Quantité : <?= $products['quantity'][$product->getId()]; ?> </li>   
    <?php endforeach; ?>
</ul>

<?php 
    if(count($products)){
        $this->includePartial("form", $checkout->getCheckoutForm()) ;
    }else{
        echo "Panier Vide";
    }
?>