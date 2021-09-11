<?php
namespace FacturaScripts\Plugins\Traducciones\Controller;

class EditTranslation extends \FacturaScripts\Core\Lib\ExtendedController\EditController
{
    public function getModelClassName() {
        return "Translation";
    }

    public function getPageData() {
        $pageData = parent::getPageData();
        $pageData["title"] = "Translation";
        $pageData["icon"] = "fas fa-search";
        return $pageData;
    }
}
