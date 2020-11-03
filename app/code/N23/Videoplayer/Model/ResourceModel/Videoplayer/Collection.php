<?php

namespace N23\Videoplayer\Model\ResourceModel\Videoplayer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'video_id';
    protected $_eventPrefix = 'n23_videoplayer_collection';
    protected $_eventObject = 'videoplayer_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('N23\Videoplayer\Model\Videoplayer', 'N23\Videoplayer\Model\ResourceModel\Videoplayer');
    }
}
