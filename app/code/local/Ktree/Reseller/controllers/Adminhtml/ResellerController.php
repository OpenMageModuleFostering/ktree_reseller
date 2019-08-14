<?php
class Ktree_Reseller_Adminhtml_ResellerController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu('reseller/reseller')->_addBreadcrumb(Mage::helper('adminhtml')->__('Reseller Manager'),Mage::helper('adminhtml')->__('Reseller Manager'));
		return $this;
	}
	public function indexAction() {
		$this->_initAction()->renderLayout();
	}

	public function editAction()
	{
		$licenseId = $this->getRequest()->getParam('id');
		$licenseModel = Mage::getModel('reseller/reseller_reseller')->load($licenseId);
		if ($licenseModel->getId() || $licenseId == 0) {
			Mage::register('reseller_data', $licenseModel);
			$this->loadLayout();
			$this->_setActiveMenu('reseller/items');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Reseller Manager'), Mage::helper('adminhtml')->__('Reseller Manager'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('reseller/adminhtml_reseller_edit'))->_addLeft($this->getLayout()->createBlock('reseller/adminhtml_reseller_edit_tabs'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('reseller')->__('Reseller does not exist'));
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
				$licenseModel = Mage::getModel('reseller/reseller_reseller');
				if( $this->getRequest()->getParam('id') <= 0 )
				$licenseModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
$data['reseller_services']=implode(',',$data['reseller_services']);  

if(isset($_FILES['reseller_img']['name']) and (file_exists($_FILES['reseller_img']['tmp_name']))) {
  try {
    $uploader = new Varien_File_Uploader('reseller_img');
    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
   $uploader->setAllowRenameFiles(false);
   $uploader->setFilesDispersion(false);
   $path = Mage::getBaseDir('media') . DS ;
            
    $uploader->save($path, $_FILES['reseller_img']['name']);
 
    $data['reseller_img'] = $_FILES['reseller_img']['name'];
  }catch(Exception $e) {
 
  } 
  }
  else {
     
     
        if(isset($data['reseller_img']['delete']) && $data['reseller_img']['delete'] == 1)
        $data['reseller_img'] = '';
    else
        unset($data['reseller_img']);
        
   }
				$licenseModel->addData($data)->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'))->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Reseller was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setResellerData(false);
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError("Reseller With this name already Exists.");
				//Mage::getSingleton('adminhtml/session')->setData($this->getRequest()->getPost());
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
				$licenseModel = Mage::getModel('reseller/reseller_reseller');
				$licenseModel->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Reseller was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
}

