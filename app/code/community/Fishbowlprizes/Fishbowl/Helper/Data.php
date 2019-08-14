<?php
	/**
		* Fishbowlprizes_Fishbowl_Helper_DataHelper
		* @category    Fishbowlprizes
		* @package     Fishbowlprizes_Fishbowl
		* @author      Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Helper_Data extends Mage_Core_Helper_Abstract
	{
		protected $_authorizeUrl = "https://www.fishbowlprizes.com/merchants/app-install/";
		protected $_uninstallUrl = "https://www.fishbowlprizes.com/merchants/remove-app/";
		protected $_scriptUrl  = "https://service.fishbowlprizes.com/widget/";

		public function checkModuleEnabled()
		{
			if(Mage::getStoreConfig('fishbowl/general/enabled')):
			return true;
			endif;
			return false;
		}
		//-------------------------------------------------------------------------
		public function authorizeRequestUrl()
		{
			$url         = $this->_authorizeUrl;
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			if ($websiteCode)
			{
				$websiteId = Mage::getModel('core/website')->load($websiteCode)->getId();
			}

			$calBackUrl  = urlencode(Mage::helper('adminhtml')->getUrl('adminhtml/fishbowl_response/post',array('website_id' => $websiteId)));

			$domian      = $this->getHostName(Mage::app()->getWebsite($websiteId)->getConfig('web/unsecure/base_url'));


			return "{$url}?app=magento&d={$domian}&cb_url={$calBackUrl}";
		}
		//-------------------------------------------------------------------------
		public function getFishbowlScript()
		{
			$EfbUrl = $this->_scriptUrl;
			$ccode  = Mage::app()->getWebsite(Mage::app()->getStore()->getWebsiteId())->getConfig('fishbowl/general/ccode');
			if($ccode)
			{
				return $EfbUrl.$ccode.'/';
			}
			return false;
		}
		//-------------------------------------------------------------------------
		public function getUninstallUrl()
		{
			$uninstall_url = $this->_uninstallUrl;
			return $uninstall_url;
		}
		//-------------------------------------------------------------------------
		public function getHostName($unsecure_base_url)
		{
			$host = parse_url($unsecure_base_url, PHP_URL_HOST);
			$path = parse_url($unsecure_base_url, PHP_URL_PATH);
			$path = rtrim($path,'index.php/');
			$host_name = $host.$path;
			return $host_name;
		}
		//-------------------------------------------------------------------------
	}

