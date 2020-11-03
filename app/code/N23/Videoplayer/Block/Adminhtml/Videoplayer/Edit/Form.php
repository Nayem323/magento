<?php

/**
 * N23_Videoplayer Add New Row Form Admin Block.
 * @category    N23
 * @package     N23_Videoplayer
 * @author      Nayem
 *
 */

namespace N23\Videoplayer\Block\Adminhtml\Videoplayer\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_wysiwygConfig;
    protected $_options;
    protected $_videoplayerOption;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \N23\Videoplayer\Model\Options\Status $options,
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_fieldFactory = $fieldFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('videoplayer_data');

        $form = $this->_formFactory->create(
            ['data' => [
                        'id' => 'edit_form',
                        'enctype' => 'multipart/form-data',
                        'action' => $this->getData('action'),
                        'method' => 'post'
                    ]
                ]
        );

        $form->setHtmlIdPrefix('n23_videoplayer_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Configure your video player'), 'class' => 'fieldset-wide']
        );
        if ($model->getVideoId()) {
            $fieldset->addField('video_id', 'hidden', ['name' => 'video_id']);
        }
        
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'video',
            'file',
            [
                'name' => 'video',
                'label' => __('Video'),
                'title' => __('Video'),
            ]
        );
        $fieldset->addField(
            'video_url',
            'text',
            [
                'name' => 'video_url',
                'label' => __(''),
                'title' => __('Video Url'),
                'note' => __('Select an Mp4 or Ogg video file. Or Paste a external video file link. (External link will have the least priority. If there is no uploaded file only then external link will work.)')
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Poster Image'),
                'title' => __('Poster Image'),
            //            'renderer' => 'N23\Videoplayer\Block\Adminhtml\School\Renderer\Image',
            ]
        );
        $fieldset->addField(
            'image_url',
            'text',
            [
                'name' => 'image_url',
                'label' => __(''),
                'title' => __('Poster Image Url'),
                'note' => __('Specifies an image to be shown while the video is downloading, or until the user hits the play button. (External link will have the least priority. If there is no uploaded file only then external link will work.)')
            ]
        );

        $fieldset->addField(
            'repeat',
            'radios',
            [
                'name' => 'repeat',
                'label' => __('Repeat'),
                'title' => __('Repeat'),
                'values' => array(
                    array('value'=>'once','label'=>'Repeat Once'),
                    array('value'=>'loop','label'=>'Repeat again and again'),
                ),
            ]
        );

        $fieldset->addField(
            'mute',
            'checkbox',
            [
                'name' => 'mute',
                'label' => __('Muted'),
                'title' => __('Muted'),
                'data-form-part' => $this->getData('mute'),
                'onchange' => 'this.value = this.checked ? 1 : 0;',
                'note' => __('Check if you want the video output should be muted')
            ]
        );

        $fieldset->addField(
            'auto_play',
            'checkbox',
            [
                'name' => 'auto_play',
                'label' => __('Auto Play'),
                'title' => __('Auto Play'),
                'data-form-part' => $this->getData('auto_play'),
                'onchange' => 'this.value = this.checked ? 1 : 0;',
                'note' => __('Check if you want video will start playing as soon as it is ready')
            ]
        );

        $fieldset->addField(
            'width',
            'text',
            [
                'name' => 'width',
                'label' => __('Player Width In pixel'),
                'title' => __('Player Width In pixel'),
                'class' => 'validate-number',
                'note' => __('Sets the player width. Height will be calculate base on the value. Left blank for Responsive Player')
            ]
        );

        $fieldset->addField(
            'seek_time',
            'text',
            [
                'name' => 'seek_time',
                'label' => __('Seek Time'),
                'title' => __('Seek Time'),
                'class' => 'validate-number',
                'note' => __('The time, in seconds, to seek when a user hits fast forward or rewind. Deafult value is 10 Sec.')
            ]
        );

        $fieldset->addField(
            'hide_control',
            'checkbox',
            [
                'name' => 'hide_control',
                'label' => __('Auto Hide Control'),
                'title' => __('Auto Hide Control'),
                'data-form-part' => $this->getData('hide_control'),
                'onchange' => 'this.value = this.checked ? 1 : 0;',
                'note' => __('Check if you want the controls (such as a play/pause button etc) hide automatically.')
            ]
        );

        $fieldset->addField(
            'preload',
            'radios',
            [
                'name' => 'preload',
                'label' => __('Preload'),
                'title' => __('Preload'),
                'values' => array(
                    array('value'=>'auto','label'=>'Auto - Browser should load the entire file when the page loads.'),
                    array('value'=>'metadata','label'=>'Metadata - Browser should load only metadata when the page loads.'),
                    array('value'=>'none','label'=>'None - Browser should NOT load the file when the page loads.'),
                ),
                'note' => __('Specify how the Video file should be loaded when the page loads.')
            ]
        );

        if (!$model->getVideoId()) {
            $model->setData('repeat', 'once');
            $model->setData('preload', 'auto');
        }
      
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        
        
        $this->setForm($form);

        return parent::_prepareForm();
    }
}

