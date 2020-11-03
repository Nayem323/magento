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
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use N23\Videoplayer\Model\ResourceModel\Videoplayer\CollectionFactory;
 
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter.?_
     * @var Filter
     */
    protected $_filter;
 
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;
 
    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
 
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
 
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection->getItems() as $record) {
            $record->setVideoId($record->getVideoId());
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));
 
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
 
    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('N23_Videoplayer::videoplayer_delete');
    }
}
