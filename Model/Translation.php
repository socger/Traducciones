<?php
namespace FacturaScripts\Plugins\Traducciones\Model;

class Translation extends \FacturaScripts\Core\Model\Base\ModelClass
{
    use \FacturaScripts\Core\Model\Base\ModelTrait;

    public $langcode;

    public $id;

    public $codpais;

    public $atraducir;

    public $traduccion;

    public function clear() {
        parent::clear();
    }

    public static function primaryColumn() {
        return "id";
    }

    public static function tableName() {
        return "translations";
    }
}
