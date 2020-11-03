<?php

namespace N23\Videoplayer\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_pageFactory;
    protected $_videoplayerFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Magento\Framework\View\Result\PageFactory $pageFactory, 
        \N23\Videoplayer\Model\VideoplayerFactory $videoplayerFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_videoplayerFactory = $videoplayerFactory;
        return parent::__construct($context);
    }

    public function execute() {

        return $this->_pageFactory->create();

    }

}
