<?php
	/**
		* Redirect to fishbowl prizes account
		* @category    Fishbowlprizes
		* @package     Fishbowlprizes_Fishbowl
		* @author      Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Adminhtml_Fishbowl_ResponseController extends Mage_Adminhtml_Controller_Action
	{
		public function postAction()
		{
			$response = Mage::app()->getRequest()->getParam('done');
			if ($response)
			{
				$ccode = Mage::app()->getRequest()->getParam('ccode');
				$rcode = Mage::app()->getRequest()->getParam('rcode');

				$websiteId = Mage::app()->getRequest()->getParam('website_id');
				try {

					$store_config = Mage::getModel('core/config');
					$store_config->saveConfig('fishbowl/general/enabled', 1, 'websites', $websiteId);
					$store_config->saveConfig('fishbowl/general/ccode', $ccode, 'websites', $websiteId);
					$store_config->saveConfig('fishbowl/general/rcode', $rcode, 'websites', $websiteId);
					Mage::app()->getStore()->resetConfig();
					echo  "<script type='text/javascript'>window.opener.location.reload(); window.close();
					</script>";
					$this->_getSession()->addSuccess(
					$this->__('Fishbowl Account configuration has been saved successfully.')
					);
				} catch (Exception $e)
				{
					$this->_getSession()->addError('There is error in configuring Fishbowl Account');
				}
				} else {
				$this->_getSession()->addError('There is error in configuring Fishbowl Account');
			}

		}
	}
