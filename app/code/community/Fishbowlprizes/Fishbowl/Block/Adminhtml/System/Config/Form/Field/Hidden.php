<?php
	/**
		* @category    Fishbowlprizes
		* @package     Fishbowlprizes_Fishbowl
		* @author      Fishbowlprizes
	*/
	class Fishbowlprizes_Fishbowl_Block_Adminhtml_System_Config_Form_Field_Hidden extends Mage_Adminhtml_Block_System_Config_Form_Field
	{

		protected function _decorateRowHtml($element, $html)
		{
			return '<tr id="row_' . $element->getHtmlId() . '" style="display: none;">' . $html . '</tr>';
		}

	}