<?php
class Ktree_Reseller_Adminhtml_ReselleraddressController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu('reseller/reselleraddress')->_addBreadcrumb(Mage::helper('adminhtml')->__('Reselleraddress Manager'),Mage::helper('adminhtml')->__('Reselleraddress Manager'));
		return $this;
	}
	public function indexAction() {
		$this->_initAction()->renderLayout();
	}

	public function editAction()
	{
		$licenseId = $this->getRequest()->getParam('id');
		$licenseModel = Mage::getModel('reseller/reseller_reselleraddress')->load($licenseId);
		if ($licenseModel->getId() || $licenseId == 0) {
			Mage::register('reseller_data', $licenseModel);
			$this->loadLayout();
			$this->_setActiveMenu('reseller/items');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Reselleraddress Manager'), Mage::helper('adminhtml')->__('Reselleraddress Manager'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('reseller/adminhtml_reselleraddress_edit'))->_addLeft($this->getLayout()->createBlock('reseller/adminhtml_reselleraddress_edit_tabs'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('reseller')->__('Reselleraddress does not exist'));
			$this->_redirect('*/*/');
		}
	}
	public function newAction()
	{
		$this->_forward('edit');
	}
	public function saveAction()
	{
		if ( $this->getRequest()->getPost() ) {

			try {
				$data = $this->getRequest()->getPost();
if(isset($data['stores'])) {
                                     $stores = $data['stores'];
                                     $storesCount = count($stores);
                                     $storesIndex = 1;
                                     $storesData = '';
                               foreach($stores as $store) {
                                      $storesData .= $store;
                                       if($storesIndex < $storesCount) {
                                            $storesData .= ',';
                                         }
                                    $storesIndex++;
                                 }
                            $data['store_id'] = $storesData;
}
				$licenseModel = Mage::getModel('reseller/reseller_reselleraddress');
				if( $this->getRequest()->getParam('id') <= 0 )
				$licenseModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
				$licenseModel->addData($data)->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'))->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Reselleraddress was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setMicrobizlicenseData(false);
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setData($this->getRequest()->getPost());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}
	public function deleteAction()
	{
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$licenseModel = Mage::getModel('reseller/reseller_reselleraddress');
				$licenseModel->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Reselleraddress was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
}
