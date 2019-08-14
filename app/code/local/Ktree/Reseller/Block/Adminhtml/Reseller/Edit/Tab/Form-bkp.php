<?php
class Ktree_Microbizlicense_Block_Adminhtml_Microbizlicense_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('microbizlicense_form', array('legend'=>Mage::helper('microbizlicense')->__('License information')));
		$fieldset->addField('customer_name', 'text', array(
'label' => Mage::helper('microbizlicense')->__('Customer Name'),
'class' => 'required-entry',
'required' => true,
'name' => 'customer_name',
		));
		$fieldset->addField('status', 'select', array(
'label' => Mage::helper('microbizlicense')->__('Status'),
'name' => 'status',
'values' => array(
		array(
'value' => 1,
'label' => Mage::helper('microbizlicense')->__('Active'),
		),
		array(
'value' => 0,
'label' => Mage::helper('microbizlicense')->__('Inactive'),
		),
		),
		));
		$fieldset->addField('license_number', 'text', array(
'label' => Mage::helper('microbizlicense')->__('License Number'),
'class' => 'required-entry',
'required' => true,
'name' => 'license_number',
		));
		
		if ( Mage::getSingleton('adminhtml/session')->getMicrobizlicenseData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getMicrobizlicenseData());
			Mage::getSingleton('adminhtml/session')->setMicrobizlicenseData(null);
		} elseif ( Mage::registry('microbizlicense_data') ) {
			$form->setValues(Mage::registry('microbizlicense_data')->getData());
		}
		return parent::_prepareForm();
	}
}
