<?php
class Ktree_Reseller_Block_Adminhtml_Reseller extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_reseller';
		$this->_blockGroup = 'reseller';
		$this->_headerText = Mage::helper('reseller')->__('Reseller');
		$this->_addButtonLabel = Mage::helper('reseller')->__('Add Reseller Information');
		parent::__construct();
	}
}
