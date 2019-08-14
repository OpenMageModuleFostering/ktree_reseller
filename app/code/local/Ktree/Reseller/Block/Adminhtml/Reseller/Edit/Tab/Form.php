<?php
class Ktree_Reseller_Block_Adminhtml_Reseller_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
protected function _prepareLayout()
    {
  
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

     protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
		$this->setForm($form);
		$fieldset = $form->addFieldset('reseller_form', array('legend'=>Mage::helper('reseller')->__('reseller information')));
		$fieldset->addField('reseller_name', 'text', array(
            'name'      => 'reseller_name',
            'label'     => Mage::helper('reseller')->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
        ));

        $fieldset->addField('reseller_img', 'image', array(
            'name'      => 'reseller_img',
            'label'     => Mage::helper('reseller')->__('Image'),
        ));

        
		
       
 /* else {
   $fieldset->addField('store_id', 'hidden', array(
           'name'      => 'stores[]',
           'value'     => Mage::app()->getStore(true)->getId()
   ));
   $model->setStoreId(Mage::app()->getStore(true)->getId());
  }*/
/*$fieldset->addField('state', 'text', array(
'label' => Mage::helper('reseller')->__('State'),
'class' => 'required-entry',
'required' => true,
'name' => 'state',
		));*/

        

$fieldset->addField('reseller_website', 'text', array(
'label' => Mage::helper('reseller')->__('Website'),
'class' => 'required-entry',
'required' => true,
'name' => 'reseller_website',
		));
		
$fieldset->addField('reseller_services', 'multiselect', array(
'label' => Mage::helper('reseller')->__('Services'),

'name' => 'reseller_services',
'values'    => array('None'=>array('label' => 'Select', 'value' => ''),
                     'Installation'=>array('label' => 'Installation', 'value' => 'Installation'),
                     'Training'=>array('label' => 'Training', 'value' => 'Training'),
                     'Hardware'=>array('label' => 'Hardware', 'value' => 'Hardware'),
                     'Repair'=>array('label' => 'Repair', 'value' => 'Repair')
                    )
		));

        $fieldset->addField('reseller_description', 'editor', array(
            'name'      => 'reseller_description',
            'label'     => Mage::helper('reseller')->__('Description'),
            'title'     => Mage::helper('reseller')->__('Description'),
            'style'     => 'width:100%;height:300px;',
            'required'  => true,
            'config'    => Mage::getSingleton('reseller/wysiwyg_config')->getConfig()
        ));


                if ( Mage::getSingleton('adminhtml/session')->getResellerData() )
                {
                        $form->setValues(Mage::getSingleton('adminhtml/session')->getResellerData());
                        Mage::getSingleton('adminhtml/session')->setResellerData(null);
                } elseif ( Mage::registry('reseller_data') ) {
                        $form->setValues(Mage::registry('reseller_data')->getData());
                }

                return parent::_prepareForm();
	}
}
