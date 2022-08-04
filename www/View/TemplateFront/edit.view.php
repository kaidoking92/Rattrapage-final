<html>
    <head>
        <title>Editer un template</title>
    </head>
    <body>
        <h1>Template</h1>
        <h3>Informations : </h3>

        <?php $this->includePartial("form", $template->getEditTemplateForm()) ?>
</html>