<?php
/**
 * Zend Framework 2 Beispiel
 * 
 * @package    Customer
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.zendframeworkbuch.de/
 */

/**
 * namespace definition and usage
 */
namespace Customer\Filter;

use Zend\Filter\AbstractFilter;
use Zend\Filter\StaticFilter;

/**
 * Filter postcode
 * 
 * @package    Customer
 */
class Postcode extends AbstractFilter
{
    /**
     * Filter value to get a five digit postcode
     *
     * @param  mixed $value
     * @return mixed
     */
    public function filter($value)
    {
        $value = StaticFilter::execute($value, 'Digits');
        $value = substr('0000' . $value, -5);

        return $value;
    }
}
