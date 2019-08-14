<?php
class Ktree_Reseller_Block_Adminhtml_Reselleraddress_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('reseller_form', array('legend'=>Mage::helper('reseller')->__('reseller information')));
		
$fieldset->addField('reseller_id', 'select', array(
        'name'  => 'reseller_id',
        'label'     => 'Reseller ',
        'required' => true,
        'values'    => Mage::getModel('reseller/reseller_reseller')->resellerName(),
    ));

$fieldset->addField('reseller_email', 'text', array(
            'name'      => 'reseller_email',
            'label'     => Mage::helper('reseller')->__('Email'),
			'class'     => 'required-entry',
            
        ));
		$fieldset->addField('reseller_phone', 'text', array(
            'label'     => Mage::helper('reseller')->__('Phone'),
            'name'      => 'reseller_phone',
			'class'     => 'required-entry',
                    ));
		$fieldset->addField('reseller_address', 'text', array(
'label' => Mage::helper('reseller')->__('Address'),
'class' => 'required-entry',
'required' => true,
'name' => 'reseller_address',
		));
$fieldset->addField('reseller_city', 'text', array(
'label' => Mage::helper('reseller')->__('City'),
'class' => 'required-entry',
'required' => true,
'name' => 'reseller_city',
		));

            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('cms')->__('Store View'),
                'title' => Mage::helper('cms')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
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
$country=$fieldset->addField('reseller_country', 'select', array(
        'name'  => 'reseller_country',
        'label'     => 'Country',
        'values'    => Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(),
    ));
/*$country->setAfterElementHtml("<script type=\"text/javascript\">
            function gettate(selectElement){
                var reloadurl = '". $this
                 ->getUrl('reseller/adminhtml_reseller/state') . "country/' + selectElement.value;
                new Ajax.Request(reloadurl, {
                    method: 'get',
                    onLoading: function (stateform) {
                        $('state').update('Searching...');
                    },
                    onComplete: function(stateform) {
                        $('state').update(stateform.responseText);
                    }
                });
            }
        </script>");*/
$fieldset->addField('reseller_state', 'text', array(
            'name'  => 'reseller_state',
            'label'     => 'State',
            /*'values'    => Mage::getModel('reseller/reseller')
                            ->getstate('AU'),*/
        ));

         /*
         * Add Ajax to the Country select box html output
         */
        


		$fieldset->addField('reseller_zip', 'text', array(
'label' => Mage::helper('reseller')->__('Zip'),
'class' => 'required-entry',
'required' => true,
'name' => 'reseller_zip',
		));
$fieldset->addField('reseller_region', 'text', array(
'label' => Mage::helper('reseller')->__('Region'),
'class' => 'required-entry',
'required' => true,
'name' => 'reseller_region',
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
