<?phpclass M_S_Block_S extends Mage_Core_Block_Template{    public function _prepareLayout()    {		return parent::_prepareLayout();    }         public function getS()          {         if (!$this->hasData('s')) {            $this->setData('s', Mage::registry('s'));        }        return $this->getData('s');            }	   public function getElement()          {          $array=  Mage::getModel('s/s')->getCollection()->getData('s');	           return $array;            }}