<?php
class Ktree_Microbizlicense_Block_Adminhtml_Microbizlicense_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('microbizlicenseGrid');
		$this->setDefaultSort('license_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}
	protected function _prepareCollection()
	{
		$collection = Mage::getModel('microbizlicense/microbizlicense')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns()
	{
		$this->addColumn('license_id', array('header' => Mage::helper('microbizlicense')->__('ID'),'align' =>'right','width' => '50px','index' => 'license_id',));
		$this->addColumn('title', array('header' => Mage::helper('microbizlicense')->__('Name'),'align' =>'left','index' => 'customer_name',));
		$this->addColumn('status', array('header' => Mage::helper('microbizlicense')->__('Status'),'align' => 'left',
										'width' => '80px',
										'index' => 'status',
										'type' => 'options',
										'options' => array(1 => 'Enabled',2 => 'Disabled',),));
		$this->addColumn('action',array(
'header' => Mage::helper('microbizlicense')->__('Action'),
'width' => '100',
'type' => 'action',
'getter' => 'getId',
'actions' => array(array(
'caption' => Mage::helper('microbizlicense')->__('Edit'),
'url' => array('base'=> '*/*/edit'),
'field' => 'id')),
'filter' => false,
'sortable' => false,
'index' => 'stores',
'is_system' => true,
));
		return parent::_prepareColumns();
	}
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}
