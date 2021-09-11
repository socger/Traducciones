<?php
namespace FacturaScripts\Plugins\Traducciones\Extension\Controller;

class EditSettings
{
    // createViews() se ejecuta una vez realiado el createViews() del controlador.
    public function createViews() {
       return function() {
            $this->createViewsTranslations();
       };
    }


    protected function createViewsTranslations()
    {
        return function (string $viewName = 'EditTranslation') {
            $this->addEditListView($viewName, 'Translation', 'translations', 'fas fa-language');
            $this->views[$viewName]->setInLine(true);
        };
    }

    // loadData() se ejecuta tras el loadData() del controlador. Recibe los parámetros $viewName y $view.
    public function loadData() {
        return function($viewName, $view) {
            switch ($viewName) {
                case 'EditTranslation':
                    $this->loadLanguageValues();
                    break;
            }
        };
    }

    /**
     * Load the available language values from translator.
     */
    protected function loadLanguageValues()
    {
        return function () {
            $columnLangCode = $this->views['EditTranslation']->columnForName('language');
            if ($columnLangCode && $columnLangCode->widget->getType() === 'select') {
                $langs = [];
                foreach ($this->toolBox()->i18n()->getAvailableLanguages() as $key => $value) {
                    $langs[] = ['value' => $key, 'title' => $value];
                }

                /// sorting
                \usort($langs, function ($objA, $objB) {
                    return \strcmp($objA['title'], $objB['title']);
                });

                $columnLangCode->widget->setValuesFromArray($langs, false);
            }
        };
    }
    
}
