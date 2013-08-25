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
 * Customer input filter
 * 
 * Filters and validates the Customer data 
 * 
 * @package    Customer
 */
class CustomerFilter extends InputFilter
{
    /**
     * Build filter
     */
    public function init()
    {
        $this->add(array(
            'name'       => 'firstname',
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
                    
        $this->add(array(
            'name'       => 'lastname',
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
        
        $this->add(
            array('type' => 'Customer\CustomerAddressFilter'), 
            'address'
        );
        
        $this->add(array(
            'name'       => 'country',
            'required'   => true,
            'validators' => array(
                array(
                    'name' => 'Customer\Country',
                ),
            ),
        ));
    }
}
