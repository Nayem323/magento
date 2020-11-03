<?php

namespace N23\Videoplayer\Model;

class Videoplayer extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'n23_videoplayer';

    protected $_cacheTag = 'n23_videoplayer';
    protected $_eventPrefix = 'n23_videoplayer';

    protected function _construct()
    {
        $this->_init('N23\Videoplayer\Model\ResourceModel\Videoplayer');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getVideoId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
