<?php

namespace N23\Videoplayer\Model\ResourceModel;

class Videoplayer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_idFieldName = 'video_id';

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('n23_videoplayer', 'video_id');
    }
}
