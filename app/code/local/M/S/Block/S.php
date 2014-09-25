<?php
class M_S_Block_S extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getS()     
     { 
        if (!$this->hasData('s')) {
            $this->setData('s', Mage::registry('s'));
        }
        return $this->getData('s');
        
    }
	
   public function getElement()     
     { 
      $customerData = Mage::getSingleton('customer/session')->getCustomer();
       $c_id = $customerData->getId();
   
      // echo Mage::getSingleton('core/resource')->getTableName('s/s');
        // $array=  Mage::getModel('s/s')->getCollection()->getData('s');
         
          $orderCollection = Mage::getModel('s/s')->getCollection();
//$test = $orderCollection->getSelect()->where('e.customer_id =' . $customerId);
          if($c_id){
          $orderCollection->getSelect()->where('c_id ='.$c_id);
          }
          $test = $orderCollection->getData('s');
	  //var_dump($test);
        return $test;
        
    }
}