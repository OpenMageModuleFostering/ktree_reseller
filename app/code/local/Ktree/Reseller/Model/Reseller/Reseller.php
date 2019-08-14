<?php

class Ktree_Reseller_Model_Reseller_Reseller extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('reseller/reseller_reseller');
    }
public function resellerName() {
$mytable = Mage::getModel('reseller/reseller_reseller')->getCollection()->getData(); 
if (is_null($this->_options)) {
$arrayval=array();
$arrayval[]=array('label' => Mage::helper('reseller')->__('Please Select'),'value' => '');
foreach($mytable as $table ) { 
            $arrayval[]=array('label' => Mage::helper('reseller')->__($table['reseller_name']),'value' =>  $table['id']);
 }  
//print_r($arrayval);    
$this->_options = $arrayval;
 }
        return $this->_options;
}
}
