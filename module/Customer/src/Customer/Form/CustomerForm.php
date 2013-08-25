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

use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;

/**
 * Customer form
 * 
 * Form for the customer
 * 
 * @package    Customer
 */
class CustomerForm extends Form
{
    /**
     * Build form
     */
    public function init()
    {
        $this->setName('customer_form');
        
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
        ));
        
        $this->add(array(
            'type'       => 'Text',
            'name'       => 'firstname',
            'options'    => array(
                'label'  => 'Vorname',
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
        
        $this->add(array(
            'type'       => 'Text',
            'name'       => 'lastname',
            'options'    => array(
                'label'  => 'Nachname',
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
        
        
        $this->add(array(
            'type'       => 'Customer\CustomerAddressFieldset',
            'name'       => 'address',
        ));

        $this->add(array(
            'type'       => 'Select',
            'name'       => 'country',
            'options'    => array(
                'label'  => 'Land',
                'value_options' => array(
                    1 => 'Deutschland', 2 => 'Österreich', 3 => 'Schweiz',
                ),
            ),
            'attributes' => array(
                'class'  => 'span5',
            ),
        ));
        
        $this->add(array(
            'type'       => 'Submit',
            'name'       => 'save',
            'options'    => array(
            ),
            'attributes' => array(
                'value'  => 'Speichern',
                'id'     => 'save',
                'class'  => 'btn btn-primary',
            ),
        ));
    }
}
