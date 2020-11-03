<?php

/**
 * @category N23
 * @package N23\Core
 * @author Nayem
 * @copyright Copyright (c) 2020 Nayem
 * @license Nayem
 */

namespace N23\Videoplayer\Controller\Adminhtml\Videoplayer;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \N23\Videoplayer\Model\GridFactory
     */
    private $videoplayerFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \N23\Videoplayer\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \N23\Videoplayer\Model\VideoplayerFactory $videoplayerFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->videoplayerFactory = $videoplayerFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $videoplayerId = (int) $this->getRequest()->getParam('video_id');
        $videoplayerData = $this->videoplayerFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($videoplayerId) {
            $videoplayerData = $videoplayerData->load($videoplayerId);

            $videoplayerTitle = $videoplayerData->getName();
            if (!$videoplayerData->getVideoId()) {
                $this->messageManager->addError(__('Player no longer exist.'));
                $this->_redirect('n23_videoplayer/videoplayer/videoplayer');
                return;
            }
        }

        $this->coreRegistry->register('videoplayer_data', $videoplayerData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $videoplayerId ? __('Edit Player') . $videoplayerTitle : __('Add New Player');

        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('N23_Videoplayer::edit');
    }
}
