<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ethos\FileNameExtension\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Catalog\Model\ResourceModel\Product\Gallery;
use Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    protected $_log;

    /**
     * @param \Ethos\FileNameExtension\Helper\Logs $log
     */
    public function __construct(
        \Ethos\FileNameExtension\Helper\Logs $log
    )
    {
        $this->_log = $log;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->_log->info("[UpgradeSchema/upgrade] : start, version =". $context->getVersion());
        if (version_compare($context->getVersion(), '0.2.0', '<')) {
            //First table to alter
            $tableName = "sales_order";
            $fileName = 'file_name';
            /*
             * Make sure that the field file_name exists in sales_order
             *
             */
            if ($setup->getConnection()->isTableExists($tableName)) {
                if (!$setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                    $tableName = $setup->getTable($tableName);
                    $setup->getConnection()->addColumn($tableName, $fileName, [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'unsigned' => true,
                        'nullable' => true,
                        'default' => 'n/a',
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'is_searchable_in_grid' => true,
                        'comment' => 'Comment'
                    ]);
                } else
                    $this->_log->info("[UpgradeSchema/upgrade] : Field {$fileName} already exists in [{$tableName}] ");
            } else {

                $this->_log->error("[UpgradeSchema/upgrade] : Table [{$tableName}] does not exist in database");
            }
            //Second table to alter
            $tableName = "sales_order_grid";
            $fileName = 'file_name';
            /*
            * Make sure that the field file_name exists in sales_order_grid
            *
            */
            if ($setup->getConnection()->isTableExists($tableName)) {
                if (!$setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                    $tableName = $setup->getTable($tableName);
                    $setup->getConnection()->addColumn($tableName, $fileName, [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'unsigned' => true,
                        'nullable' => true,
                        'default' => 'n/a',
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'is_searchable_in_grid' => true,
                        'comment' => 'Comment'
                    ]);
                } else
                    $this->_log->info("[UpgradeSchema/upgrade] : Field {$fileName} already exists in [{$tableName}] ");
            } else {

                $this->_log->error("[UpgradeSchema/upgrade] : Table [{$tableName}] does not exists in database");
            }
        }
        /*
         * Add options for the file_name column (is used in grid, visible, searchable, filterable)

        if (version_compare($context->getVersion(), '0.3.0', '<')) {

            //First table to alter
            $tableName = "sales_order";
            $fileName = 'file_name';
            if ($setup->getConnection()->isTableExists($tableName)) {
                if ($setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                    $tableName = $setup->getTable($tableName);

                    $setup->getConnection()->changeColumn($tableName, $fileName, $fileName, [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'unsigned' => true,
                        'nullable' => true,
                        'default' => 'n/a',
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'is_searchable_in_grid' => true,
                        'comment' => 'Comment'
                    ]);
                } else
                    $this->_log->info("[UpgradeSchema/upgrade] : Field {$fileName} does not exist in [{$tableName}] ");
            } else {

                $this->_log->error("[UpgradeSchema/upgrade] : Table [{$tableName}] does not exist in database");
            }
            //Second table to alter
            $tableName = "sales_order_grid";
            $fileName = 'file_name';
            if ($setup->getConnection()->isTableExists($tableName)) {
                if ($setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                    $tableName = $setup->getTable($tableName);
                    $setup->getConnection()->changeColumn($tableName, $fileName, $fileName, [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'unsigned' => true,
                        'nullable' => true,
                        'default' => 'n/a',
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => true,
                        'is_filterable_in_grid' => true,
                        'is_searchable_in_grid' => true,
                        'comment' => 'Comment'
                    ]);
                } else
                    $this->_log->info("[UpgradeSchema/upgrade] : Field {$fileName} does not exist in [{$tableName}] ");
            } else {

                $this->_log->error("[UpgradeSchema/upgrade] : Table [{$tableName}] does not exist in database");
            }
        }
        $this->_log->info("[UpgradeSchema/upgrade] : finish");
        $setup->endSetup();

        */
    }
}
