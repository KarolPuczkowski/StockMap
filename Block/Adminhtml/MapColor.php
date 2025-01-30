<?php
namespace SkiDev\StockMap\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\App\ResourceConnection;

class Map extends Template
{
    protected $resource;

    public function __construct(
        Template\Context $context,
        ResourceConnection $resource,
        array $data = []
    ) {
        $this->resource = $resource;
        parent::__construct($context, $data);
    }

    public function getStockSources($stockId = null, $magazineId = null)
    {
        $connection = $this->resource->getConnection();
        $table = $this->resource->getTableName('inventory_source_stock_link'); // This table contains stock_id
        $sourceTable = $this->resource->getTableName('inventory_source'); // This table contains source details

        // Query to fetch sources
        $query = $connection->select()
            ->from(['link' => $table], [])
            ->join(['source' => $sourceTable], 'link.source_code = source.source_code', ['latitude', 'longitude', 'name'])
            ->columns(['stock_id' => 'link.stock_id']); // Select stock_id from the correct table
        
        // If a specific stock_id is provided, filter by it
        if ($stockId) {
            $query->where('link.stock_id = ?', $stockId);
        }
        
        // Fetch all sources or those specific to the stock
        $sources = $connection->fetchAll($query);
        
        // Set the data for use in the template
        $this->setData('sources', $sources);
        $this->setData('magazine_id', $magazineId);
    }
}
