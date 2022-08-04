<h1>
    <?= $page->getTitle();?>
</h1>

<div class="pageContent">
    <?= $page->getContent(); ?>
</div>

<div class="pageComments">
    <?php include "View/Comment/commentpage.view.php"; ?>
</div>