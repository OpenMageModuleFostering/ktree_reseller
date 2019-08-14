<?php

class Ktree_Reseller_Model_Mysql4_Reseller_Reseller extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
   
        $this->_init('reseller/reseller_reseller', 'id');
    }
}
