<?php

class Ktree_Reseller_Model_Reseller_Reselleraddress extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('reseller/reseller_reselleraddress');
    }
}
