<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 27-Sep-16
 * Time: 2:36 PM
 */

namespace App\Contento;


use Sylius\Component\Pricing\Calculator\VolumeBasedCalculator;

class pricing
{


    public function GetCost($quantity)
    {
        $volumeCalculator = new VolumeBasedCalculator();
        $configuration = array(
            array(            // if quantity is between 2-9 the price is for each 300
                'min' => 2,
                'max' => 5,
                'price' => 0.95,
            ),
            array(
                'min' => 6, // if is more than 10 then price is 200
                'max' => 10,
                'price' => 0.90,
            ),
            array(
                'min' => 11, // if is more than 10 then price is 200
                'max' => 20,
                'price' => 0.85,
            ),
            array(
                'min' => 21, // if is more than 10 then price is 200
                'max' => null,
                'price' => 0.80,
            ),
        );// else is 599 (because the price from book is 599)

        $book = new Book();
        $book->setPricingConfiguration($configuration);
        $book->setPrice(1);

// if you don't pass $context to calculate method then quantity will be 1
        $context = array('quantity' => $quantity);

        $cost = $volumeCalculator->calculate($book, $book->getPricingConfiguration(), $context); // returns 300

        return $cost;
    }


    public function GetPriceperDuration($quantity)
    {
        $volumeCalculator = new VolumeBasedCalculator();
        $configuration = array(
            array(            // if quantity is between 2-9 the price is for each 300
                'min' => 3,
                'max' => 5,
                'price' => 0.95,
            ),
            array(
                'min' => 6, // if is more than 10 then price is 200
                'max' => 11,
                'price' => 0.90,
            ),
            array(
                'min' => 12, // if is more than 10 then price is 200
                'max' => 23,
                'price' => 0.85,
            ),
            array(
                'min' => 24, // if is more than 10 then price is 200
                'max' => null,
                'price' => 0.80,
            ),
        );// else is 599 (because the price from book is 599)

        $book = new Book();
        $book->setPricingConfiguration($configuration);
        $book->setPrice(1);

// if you don't pass $context to calculate method then quantity will be 1
        $context = array('quantity' => $quantity);

        $cost = $volumeCalculator->calculate($book, $book->getPricingConfiguration(), $context); // returns 300

        return $cost;
    }


}