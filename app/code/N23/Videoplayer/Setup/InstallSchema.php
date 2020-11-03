<?php

namespace N23\Videoplayer\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
         $installer->getConnection()->dropTable($installer->getTable('n23_videoplayer'));
         $installer->getConnection()->dropTable($installer->getTable('n23_videoplayer'));
        if (!$installer->tableExists('n23_videoplayer')) {
            $table = $installer->getConnection()->newTable($installer->getTable('n23_videoplayer'))
                    ->addColumn('video_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Video Id')
                    ->addColumn('title', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true], 'Title')
                    ->addColumn('video', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true], 'Video')
                    ->addColumn('video_url', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true], 'Video Url')
                    ->addColumn('image', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true], 'Image')
                    ->addColumn('image_url', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true], 'Image Url')
                    ->addColumn('repeat', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, ['nullable' => true], 'Repeat')
                    ->addColumn('mute', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, ['nullable' => true], 'Mute')
                    ->addColumn('auto_play', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, ['nullable' => true], 'Auto Play')
                    ->addColumn('width', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 10, ['nullable' => true], 'Width')
                    ->addColumn('seek_time', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 10, ['nullable' => true], 'Seek Time')
                    ->addColumn('hide_control', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, ['nullable' => true], 'Hide Control')
                    ->addColumn('preload', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, ['nullable' => true], 'Preload')
                    ->setComment('Videoplayer Table');
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('n23_videoplayer'),
                $setup->getIdxName(
                    $installer->getTable('n23_videoplayer'),
                    ['title', 'video','image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['title', 'video','image'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
