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
namespace Customer\Form;

use Zend\Form\Fieldset;

/**
 * Customer address fieldset
 * 
 * Fieldset for the customer address data 
 * 
 * @package    Customer
 */
class CustomerAddressFieldset extends Fieldset
{
    /**
     * Build fieldset
     */
    public function init()
    {
        $this->setName('address');
        $this->setLabel('Adressdaten');
        
        $this->add(array(
            'type'       => 'Text',
            'name'       => 'street',
            'options'    => array(
                'label'  => 'Straße',
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
        
        $this->add(array(
            'type'       => 'Text',
            'name'       => 'postcode',
            'options'    => array(
                'label'  => 'Postleitzahl',
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
        
        $this->add(array(
            'type'       => 'Text',
            'name'       => 'city',
            'options'    => array(
                'label'  => 'Stadt',
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
    }
}
