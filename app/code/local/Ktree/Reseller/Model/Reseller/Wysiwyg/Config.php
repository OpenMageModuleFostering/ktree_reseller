<?php
class Ktree_Reseller_Model_Reseller_Wysiwyg_Config extends Mage_Cms_Model_Wysiwyg_Config
{

    /**
     * Return Wysiwyg config as Varien_Object
     *
     * Config options description:
     *
     * enabled:                 Enabled Visual Editor or not
     * hidden:                  Show Visual Editor on page load or not
     * use_container:           Wrap Editor contents into div or not
     * no_display:              Hide Editor container or not (related to use_container)
     * translator:              Helper to translate phrases in lib
     * files_browser_*:         Files Browser (media, images) settings
     * encode_directives:       Encode template directives with JS or not
     *
     * @param $data Varien_Object constructor params to override default config values
     *
     * @return Varien_Object
     */
    public function getConfig($data = array())
    {
		$config = parent::getConfig($data);
		$config->setData('files_browser_window_url',Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index/'));
		$config->setData('directives_url',Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive'));
		$config->setData('directives_url_quoted', preg_quote($config->getData('directives_url')));
		$config->setData('widget_window_url',Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index'));
		return $config;
    }

}
