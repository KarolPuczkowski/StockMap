<?php
namespace SkiDev\StockMap\Model;

use Magento\Inventory\Model\Source as MagentoSource;

class Source extends MagentoSource
{
    /**
     * Get the stock map marker color
     * 
     * @return string|null
     */
    public function getStockmapMarkerColor()
    {
        return $this->_getData('stockmap_marker_color');
    }

    /**
     * Set the stock map marker color
     *
     * @param string $color
     * @return $this
     */
    public function setStockmapMarkerColor($color)
    {
        return $this->setData('stockmap_marker_color', $color);
    }
}
