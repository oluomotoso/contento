<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 27-Sep-16
 * Time: 2:38 PM
 */

namespace App\Contento;
use Sylius\Component\Pricing\Model\PriceableInterface;


class Book implements PriceableInterface
{
    /**
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $calculator;

    /**
     * @var array
     */
    private $configuration;

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * {@inheritdoc}
     */
    public function getPricingCalculator()
    {
        return $this->calculator;
    }

    /**
     * {@inheritdoc}
     */
    public function setPricingCalculator($calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * {@inheritdoc}
     */
    public function getPricingConfiguration()
    {
        return $this->configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function setPricingConfiguration(array $configuration)
    {
        $this->configuration = $configuration;
    }
}