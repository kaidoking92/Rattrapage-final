<?php

namespace App\Core;
use App\Security\TemplateSecurity;
use App\Model\Page;

class Template
{

    public static function getActiveTemplate()
    {
        $templateSecurity = new TemplateSecurity();
        $template = $templateSecurity->findByCustom("active", 1);

        return $template;
    }

    public static function getPages()
    {
        $page = new Page();
        $pages = $page->getAll();

        return $pages;
    }
    
}
