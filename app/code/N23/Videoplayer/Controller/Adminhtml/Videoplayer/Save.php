<?php

/**
 * @category N23
 * @package N23\Core
 * @author Nayem
 * @copyright Copyright (c) 2020 Nayem
 * @license Nayem
 */

namespace N23\Videoplayer\Controller\Adminhtml\Videoplayer;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action
{

    /**
     * @var \N23\Videoplayer\Model\VideoplayerFactory
     */
    protected $videoplayerFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \N23\Videoplayer\Model\GridFactory $gridFactory
     */
    public function __construct(
        Context $context,
        \N23\Videoplayer\Model\VideoplayerFactory $videoplayerFactory
    ) {
        parent::__construct($context);
        $this->videoplayerFactory = $videoplayerFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $video = $this->getRequest()->getFiles('video');
        $fileName = ($video && array_key_exists('name', $video)) ? $video['name'] : null;
        if ($video && $fileName) {
            try {
                /** @var \Magento\Framework\ObjectManagerInterface $uploader */
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'video']);
                $uploader->setAllowedExtensions(['mp4', 'ogg']);
                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapterFactory */
                $imageAdapterFactory = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                //If FilesDispersion set to “false” then your file uploaded to the same path, and if you set it to “true” then it first creates two folders with first two letters of image’s name, and then upload your image inside that folder
                $uploader->setFilesDispersion(false);
                $uploader->setAllowCreateFolders(true);
                /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('video'));

                $data['video'] = 'video/' . $result['file'];
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
            if (isset($data['video']['delete'])) {
                $data['video'] = '';
            } else {
                unset($data['video']);
            }
        }

        $image = $this->getRequest()->getFiles('image');
        $fileName = ($image && array_key_exists('name', $image)) ? $image['name'] : null;
        if ($image && $fileName) {
            try {
                /** @var \Magento\Framework\ObjectManagerInterface $uploader */
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'mp4']);
                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapterFactory */
                $imageAdapterFactory = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                //If FilesDispersion set to “false” then your file uploaded to the same path, and if you set it to “true” then it first creates two folders with first two letters of image’s name, and then upload your image inside that folder
                $uploader->setFilesDispersion(false);
                $uploader->setAllowCreateFolders(true);
                /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('video'));

                $data['image'] = 'video/' . $result['file'];
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
            if (isset($data['image']['delete'])) {
                $data['image'] = '';
            } else {
                unset($data['image']);
            }
        }

        if (!$data) {
            $this->_redirect('n23_videoplayer/videoplayer/edit');
            return;
        }
        try {
            $videoplayerData = $this->videoplayerFactory->create();
            $videoplayerData->setData($data);

            if (isset($data['video_id'])) {
                $videoplayerData->setVideoId($data['video_id']);
            }

            $videoplayerData->save();

            $this->messageManager->addSuccess(__('Player has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('n23_videoplayer/videoplayer/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('N23_Videoplayer::save');
    }
}
