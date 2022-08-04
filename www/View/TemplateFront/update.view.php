<html>
    <head>
        <title>Template activer</title>
    </head>
    <body>
        <h1>Activer</h1>
        <form action="<?php echo $this->getUrl("Template", "activateTemplate"); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $template->getId(); ?>" />
            <input type="submit" value="activer" />
        </form>
    </body>
</html>