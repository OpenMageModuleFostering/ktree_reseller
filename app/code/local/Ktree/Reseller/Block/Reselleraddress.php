<?php
class Ktree_Reseller_Block_Reselleraddress extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getReseller()     
     { 
        if (!$this->hasData('reseller')) {
            $this->setData('reseller', Mage::registry('reseller'));
        }
        return $this->getData('reseller');
        
    }
}
