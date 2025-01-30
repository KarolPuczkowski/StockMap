<?php
namespace SkiDev\StockMap\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('inventory_source')) {
            return;
        }

        $table = $setup->getTable('inventory_source');

        // Add the new field to the source table
        $setup->getConnection()->addColumn(
            $table,
            'stockmap_marker_color',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'default' => null,
                'comment' => 'Stock Map Marker Color'
            ]
        );

        $setup->endSetup();
    }
}
