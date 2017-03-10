<?php

namespace Ethos\FileNameExtension\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
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
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->_log->info("[InstallSchema/install] : start");
        $setup->startSetup();
        //First table to alter
        $tableName = "sales_order";
        $fileName = 'file_name';
        if($setup->getConnection()->isTableExists($tableName)) {
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
            }
            else
                $this->_log->info("[InstallSchema/install] : Field {$fileName} already exists in [{$tableName}]");
        }
        else {

            $this->_log->error("[InstallSchema/install] : Table [{$tableName}] does not exist in database");
        }
        //Second table to alter
        $tableName = "sales_order_grid";
        $fileName = 'file_name';
        if($setup->getConnection()->isTableExists($tableName)) {
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
            }
            else
                $this->_log->info("[InstallSchema/install] : Field {$fileName} already exists in [{$tableName}]");
        }
        else {

            $this->_log->error("[InstallSchema/install] : Table [{$tableName}] does not exist in database");
        }
        $this->_log->info("[InstallSchema/install] : finish");
        $setup->endSetup();
    }
}
