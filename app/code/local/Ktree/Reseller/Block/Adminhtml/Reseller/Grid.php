<?php
class Ktree_Reseller_Block_Adminhtml_Reseller_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
		$collection = Mage::getModel('reseller/reseller_reseller')->getCollection();
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

        $this->addColumn('reseller_name', array(
            'header'    => Mage::helper('reseller')->__('Name'),
            'align'     => 'left',
            'index'     => 'reseller_name',
        ));

        
	
		$this->addColumn('reseller_website', array(
            'header'    => Mage::helper('reseller')->__('Website'),
            'align'     => 'left',
            'index'     => 'reseller_website',
        ));
$this->addColumn('reseller_services', array(
            'header'    => Mage::helper('reseller')->__('Services'),
            'align'     => 'left',
            'index'     => 'reseller_services',
        ));
$this->addColumn('reseller_description', array(
            'header'    => Mage::helper('reseller')->__('Description'),
            'align'     => 'left',
            'index'     => 'reseller_description',
        ));

		return parent::_prepareColumns();
	}
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}
