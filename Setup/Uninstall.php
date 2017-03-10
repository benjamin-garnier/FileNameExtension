<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 08/03/2017
 * Time: 14:23
 */

namespace Ethos\DataFileManager\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Uninstall implements \Magento\Framework\Setup\UninstallInterface
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
     * Invoked when remove-data flag is set during module uninstall.
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->_log->info("[UninstallSchema/uninstall] : start");
        $setup->startSetup();
        $tableName = "sales_order";
        $fileName = 'file_name';
        if ($setup->getConnection()->isTableExists($tableName)) {
            if ($setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                $tableName = $setup->getTable($tableName);
                $setup->getConnection()->dropColumn($tableName, $fileName);
            } else
                $this->_log->info("[InstallSchema/install] : Field {$fileName} does not exist in [{$tableName}]");
        } else {

            $this->_log->error("[InstallSchema/install] : Table [{$tableName}] does not exist in database");
        }
        //Second table to alter
        $tableName = "sales_order_grid";
        $fileName = 'file_name';
        if ($setup->getConnection()->isTableExists($tableName)) {
            if ($setup->getConnection()->tableColumnExists($tableName, $fileName)) {
                $tableName = $setup->getTable($tableName);
                $setup->getConnection()->dropColumn($tableName, $fileName);
            } else
                $this->_log->info("[InstallSchema/install] : Field {$fileName} does not exist in [{$tableName}]");
        } else {
            $this->_log->error("[InstallSchema/install] : Table [{$tableName}] does not exist in database");
        }
        $this->_log->info("[UninstallSchema/uninstall] : finish");
        $setup->endSetup();
    }
}