<?php
	/**
		* Remove fishbowl widget in fishbowl account
		* @category    Fishbowlprizes
		* @package     Fishbowlprizes_Fishbowl
		* @author      Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Adminhtml_SetupController extends Mage_Adminhtml_Controller_Action
	{
		public function uninstallAction()
		{
			$params = $this->getRequest()->getParams();
			$websiteId = $params['website_id'];
			try
			{
				$response = $this->_uninstallFishbowl($websiteId);
				if($response == 'success')
				{
					$store_config = Mage::getModel('core/config');
					$store_config->saveConfig('fishbowl/general/enabled', 0, 'websites', $websiteId);
					$store_config->saveConfig('fishbowl/general/ccode', NULL, 'websites', $websiteId);
					$store_config->saveConfig('fishbowl/general/rcode', NULL, 'websites', $websiteId);
					Mage::app()->getStore()->resetConfig();

					$this->_getSession()->addSuccess($this->__('Fishbowl account has been successfully removed.'));
					} else {
					$this->_getSession()->addError($this->__('Account removal failed. Please try again.'));
				}
			}
			catch(Exception $e){
				$this->_getSession()->addError($this->__('Account removal failed. Please try again.'));
			}
			$this->_redirectReferer();
		}

		protected function _uninstallFishbowl($websiteId)
		{
			$url 	= Mage::helper('fishbowl')->getUninstallUrl();
			$rcode  = Mage::app()->getWebsite($websiteId)->getConfig('fishbowl/general/rcode');
			$params = '?rcode='.$rcode;
			$get_url = $url.$params;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $get_url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$result = curl_exec($ch);
			curl_close($ch);

			return $result;
		}

	}

?>