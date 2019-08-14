<?php
	/**
		* In System Configuration Button widget
		* @category    Fishbowlprizes
		* @package     Fishbowlprizes_Fishbowl
		* @author      Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Block_Adminhtml_System_Config_Form_Field_Html extends Mage_Adminhtml_Block_System_Config_Form_Field
	{

		protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
		{
			$this->setElement($element);
			$buttonBlock = $this->getLayout()->createBlock('adminhtml/widget_button');

			$websiteCode = $buttonBlock->getRequest()->getParam('website');
			$websiteId = Mage::app()->getStore()->getWebsiteId();
			if ($websiteCode)
			{
				$websiteId = Mage::getModel('core/website')->load($websiteCode)->getId();
			}

			$params = array(
            'website' => $websiteCode,
			'website_id' => $websiteId
			);

			$fishbowl_script = Mage::app()->getWebsite($websiteCode)->getConfig('fishbowl/general/rcode');
			if($fishbowl_script)
			{
				$data = array(
				'label'     => Mage::helper('adminhtml')->__('Remove Account'),
				'onclick'   => 'confirmSetLocation(\'Are you sure?\',\''.Mage::helper('adminhtml')->getUrl("adminhtml/setup/uninstall", $params) . '\')',
				'class'     => 'delete',
				'after_html'=>'<p class="note"><span>Your Account will be removed from fishbowlprizes.com also. </span></p>'
				);
			}
			else
			{
				$data = array(
				'label'     => Mage::helper('adminhtml')->__('Get Access'),
				'onclick'   => "javascript:window.open('". Mage::helper('fishbowl')->authorizeRequestUrl()."',
				'apiwizard','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, ,left=100, top=100, width=500, height=700')",
				'after_html'=>'<p class="note"><span>You will be redirected to fishbowlprizes.com and login using your access details. </span></p>'
				);
			}
			$html = $buttonBlock->setData($data)->toHtml();
			return $html;
		}

	}
?>
