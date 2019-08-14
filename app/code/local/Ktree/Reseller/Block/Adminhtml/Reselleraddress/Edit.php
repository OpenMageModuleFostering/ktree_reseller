<?php
class Ktree_Reseller_Block_Adminhtml_Reselleraddress_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = 'id';
		$this->_blockGroup = 'reseller';
		$this->_controller = 'adminhtml_reselleraddress';
		$this->_updateButton('save', 'label', Mage::helper('reseller')->__('Save Reselleraddress data'));
		$this->_updateButton('delete', 'label', Mage::helper('reseller')->__('Delete Reselleraddress data'));
	}
	public function getHeaderText()
	{
		if( Mage::registry('reseller_data') && Mage::registry('reseller_data')->getId() ) {
		return Mage::helper('reseller')->__("Edit Reselleraddress Data '%s'", $this->htmlEscape(Mage::registry('reseller_data')->getTitle()));
	} 
	else {
		return Mage::helper('reseller')->__('Add Reselleraddress');
	}
	}
}
