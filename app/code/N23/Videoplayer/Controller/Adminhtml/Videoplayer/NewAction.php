<?php

/**
 * @category N23
 * @package N23\Core
 * @author Nayem
 * @copyright Copyright (c) 2020 Nayem
 * @license Nayem
 */

namespace N23\Videoplayer\Controller\Adminhtml\Videoplayer;

class NewAction extends \Magento\Backend\App\Action
{

    protected $_resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
