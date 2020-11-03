<?php
namespace N23\Videoplayer\Block\Adminhtml;

class Videoplayer extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_videoplayer';
        $this->_blockGroup = 'N23_Videoplayer';
        $this->_headerText = __('Videoplayer');
        $this->_addButtonLabel = __('Add New Player');
        parent::_construct();
    }
}
