<?php
class Ktree_Reseller_Block_Adminhtml_Reselleraddress extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_reselleraddress';
		$this->_blockGroup = 'reseller';
		$this->_headerText = Mage::helper('reseller')->__('Reseller');
		$this->_addButtonLabel = Mage::helper('reseller')->__('Add Reseller Address');
		parent::__construct();
	}
}
