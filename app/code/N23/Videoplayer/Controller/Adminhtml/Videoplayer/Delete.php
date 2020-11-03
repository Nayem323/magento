<?php

/**
 * @category N23
 * @package N23\Core
 * @author Nayem
 * @copyright Copyright (c) 2020 Nayem
 * @license Nayem
 */

namespace N23\Videoplayer\Controller\Adminhtml\Videoplayer;

//use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \N23\Videoplayer\Model\GridFactory
     */
    protected $videoplayerFactory;
    protected $helperData;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \N23\Videoplayer\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \N23\Videoplayer\Model\VideoplayerFactory $videoplayerFactory
    ) {
        parent::__construct($context);
        $this->videoplayerFactory = $videoplayerFactory;
    }

    public function execute()
    {
        $videoplayerId = $this->getRequest()->getParam('video_id');
        $model = $this->_objectManager->create('N23\Videoplayer\Model\Videoplayer');
        $model = $model->setVideoId($videoplayerId);
        
        try {
            $model->delete();
            $this->messageManager->addSuccess(
                __('Player Deleted Successfully')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
