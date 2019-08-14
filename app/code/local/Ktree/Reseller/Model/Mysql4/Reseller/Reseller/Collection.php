<?php

class Ktree_Reseller_Model_Mysql4_Reseller_Reseller_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('reseller/reseller_reseller');
    }
}
