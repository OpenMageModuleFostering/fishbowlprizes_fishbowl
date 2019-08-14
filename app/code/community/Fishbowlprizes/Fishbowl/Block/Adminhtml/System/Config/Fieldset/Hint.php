<?php

	/**
		* Renderer for fishbowl banner in System Configuration
		* @category   fishbowl
		* @package    Fishbowlprizes_Fishbowl
		* @author     Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Block_Adminhtml_System_Config_Fieldset_Hint
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
	{
		protected $_template = 'fishbowl/system/config/fieldset/hint.phtml';

		/**
			* Render fieldset html
			* @param Varien_Data_Form_Element_Abstract $element
			* @return string
		*/
		public function render(Varien_Data_Form_Element_Abstract $element)
		{
			return $this->toHtml();
		}

		public function getEfishbowlVersion()
		{
			return (string)Mage::getConfig()->getNode('modules/Fishbowlprizes_Fishbowl/version');
		}


	}

?>

