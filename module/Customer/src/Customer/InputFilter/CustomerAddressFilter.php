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
namespace Customer\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Customer address input filter
 * 
 * Filters and validates the Customer address data 
 * 
 * @package    Customer
 */
class CustomerAddressFilter extends InputFilter
{
    /**
     * Build filter
     */
    public function init()
    {
        $this->add(array(
            'name'       => 'street',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'Alnum',
                    'options' => array('allowWhiteSpace' => true)
                ),
                array(
                    'name'    => 'StringLength',
                    'options' => array('min' => '3', 'max' => '64')
                ),
            ),
        ));
                    
        $this->add(array(
            'name'       => 'postcode',
            'required'   => true,
            'filters'    => array(
                array('name' => 'Customer\Postcode'),
            ),
            'validators' => array(
                array(
                    'name'      => 'Postcode',
                    'locale'    => 'de_DE',
                ),
            ),
        ));
                    
        $this->add(array(
            'name'       => 'city',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'Alpha',
                    'options' => array('allowWhiteSpace' => true)
                ),
                array(
                    'name'    => 'StringLength',
                    'options' => array('min' => '3', 'max' => '64')
                ),
            ),
        ));
    }
}
