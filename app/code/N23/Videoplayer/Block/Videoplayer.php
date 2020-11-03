<?php
/**
 * Copyright © N23, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace N23\Videoplayer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Videoplayer extends Template implements BlockInterface
{
    protected $_template = "widget/videoplayer.phtml";
    protected $_videoplayerFactory;
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \N23\Videoplayer\Model\VideoplayerFactory $videoplayerFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_videoplayerFactory = $videoplayerFactory;
    }

    public function getVideoplayer(){
        $videoplayer = $this->_videoplayerFactory->create()->load($this->getVideoId());
        return $videoplayer;
    }
}
