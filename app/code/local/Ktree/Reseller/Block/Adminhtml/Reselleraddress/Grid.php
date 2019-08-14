<?php
class Ktree_Reseller_Block_Adminhtml_Reselleraddress_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('resellerGrid');
		$this->setDefaultSort('id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}
	protected function _prepareCollection()
	{
		$collection = Mage::getModel('reseller/reseller_reselleraddress')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns()
	{
		

$this->addColumn('id', array(
            'header'    => Mage::helper('reseller')->__('Id'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'id',
            'type'      => 'number',
        ));
$this->addColumn('reseller_id', array(
            'header'    => Mage::helper('reseller')->__('Reseller Id'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'reseller_id',
            'type'      => 'number',
        ));

        

        $this->addColumn('reseller_email', array(
            'header'    => Mage::helper('reseller')->__('Email'),
            'align'     => 'left',
            'index'     => 'reseller_email',
        ));
$this->addColumn('reseller_city', array(
            'header'    => Mage::helper('reseller')->__('City'),
            'align'     => 'left',
            'index'     => 'reseller_city',
        ));
		$this->addColumn('reseller_country', array(
            'header'    => Mage::helper('reseller')->__('Country'),
            'align'     => 'left',
            'index'     => 'reseller_country',
        ));
		$this->addColumn('reseller_state', array(
            'header'    => Mage::helper('reseller')->__('State'),
            'align'     => 'left',
            'index'     => 'reseller_state',
        ));
		/*$this->addColumn('store_id', array(
            'header'    => Mage::helper('reseller')->__('Store'),
            'align'     => 'left',
            'index'     => 'store_id',
        ));*/

		return parent::_prepareColumns();
	}
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}
