<?php
namespace SkiDev\StockMap\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\App\ResourceConnection;
use Magento\Backend\Model\UrlInterface;

class Map extends Template
{
    protected $resource;
    protected $backendUrl;

    public function __construct(
        Template\Context $context,
        ResourceConnection $resource,
        UrlInterface $backendUrl,
        array $data = []
    ) {
        $this->resource = $resource;
        $this->backendUrl = $backendUrl;
        parent::__construct($context, $data);
    }

    public function getStockSources($stockId = null)
    {
        $connection = $this->resource->getConnection();
        $table = $this->resource->getTableName('inventory_source_stock_link'); 
        $sourceTable = $this->resource->getTableName('inventory_source');

        if ($stockId) {
            $query = $connection->select()
                ->from(['link' => $table], [])
                ->join(['source' => $sourceTable], 'link.source_code = source.source_code', ['latitude', 'longitude', 'name'])
                ->where('link.stock_id = ?', $stockId);
        } else {
            $query = $connection->select()
                ->from(['link' => $table], [])
                ->join(['source' => $sourceTable], 'link.source_code = source.source_code', ['latitude', 'longitude', 'name', 'region', 'postcode', 'city', 'street', 'email', 'source_code']);
        }

        return $connection->fetchAll($query);
    }

    /**
     * Generate admin edit URL for a given source code.
     *
     * @param string $sourceCode
     * @return string
     */
    public function getAdminSourceEditUrl($sourceCode)
    {
        return $this->backendUrl->getUrl('inventory/source/edit', ['source_code' => $sourceCode]);
    }
}
