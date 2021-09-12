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

//    public function clear() {
//        parent::clear();
//    }

    public static function primaryColumn() {
        return "id";
    }

    public static function tableName() {
        return "translations";
    }

    public function test()
    {
        $utils = $this->toolBox()->utils();
        $this->langcode = $utils->noHtml($this->langcode);
        $this->codpais = $utils->noHtml($this->codpais);
        $this->atraducir = $this->toolBox()->utils()->noHtml($this->atraducir);
        $this->traduccion = $this->toolBox()->utils()->noHtml($this->traduccion);

        return parent::test();
    }

    protected function crearJsonTraslation($id): bool
    {
        // VER CON CARLOS ... si da error al crear el .json que devuelva false el return
        return true; // Se creó el json
    }

    protected function guardar(string $type, array $values = []): bool
    {
        $id = $this->id;
        
        if ($type === 'U') {
            $aDevolver = parent::saveUpdate($values);
        } else {
            $aDevolver = parent::saveInsert($values);
        }
        
        if (true === $aDevolver) {
            if (true !== $this->crearJsonTraslation($id)) {
                $this->toolBox()->i18nLog()->error('Aunque la traducción se creó correctamente, el fichero .json no se llegó a crear.');
            }
            return true;
        }

        return $aDevolver;
    }

    // Para realizar cambios en los datos antes de guardar por modificación
    protected function saveUpdate(array $values = [])
    {
        return $this->guardar('U', $values);
    }

    // Para realizar cambios en los datos antes de guardar por alta
    protected function saveInsert(array $values = [])
    {
        return $this->guardar('I', $values);
    }
    
}
