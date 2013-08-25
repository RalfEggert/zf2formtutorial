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
namespace Customer\Service;

use Application\Service\AbstractModelService;
use Customer\Entity\CustomerEntity;
use Customer\Hydrator\CustomerDbHydrator;
use Customer\InputFilter\CustomerFilter;
use Customer\Table\CustomerTable;
use Zend\Db\Adapter\Exception\InvalidQueryException;
use Zend\EventManager\EventManagerInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

/**
 * Customer customer Service
 * 
 * @package    Customer
 */
class CustomerService extends AbstractModelService
{
    /**
     * @var CustomerTable
     */
    protected $table;
    
    /**
     * @var CustomerFilter
     */
    protected $filter;
    
    /**
     * Constructor
     * 
     * @param EventManagerInterface $eventManager
     * @param CustomerTable $table
     */
    public function __construct(EventManagerInterface $eventManager, CustomerTable $table, CustomerFilter $filter)
    {
        $eventManager->setIdentifiers(array(__CLASS__));
        
        $this->setEventManager($eventManager);
        $this->setTable($table);
        $this->setFilter($filter);
    }
    
    /**
     * Get table
     * 
     * @return CustomerTable
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * Set table
     * 
     * @param CustomerTable $table
     * @return CustomerService;
     */
    public function setTable(CustomerTable $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get filter
     * 
     * @return CustomerFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }
    
    /**
     * Set filter
     * 
     * @param CustomerFilter $filter
     * @return CustomerService;
     */
    public function setFilter(CustomerFilter $filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Fetch single by id
     *
     * @param varchar $id
     * @return CustomerEntity
     */
    public function fetchSingleById($id)
    {
        return $this->getTable()->fetchSingleById($id);
    }
    
    /**
     * Fetch list of customers
     *
     * @param integer $country country code
     * @return CustomerEntity[]
     */
    public function fetchList($country = null)
    {
        return $this->getTable()->fetchList($country);
    }
    
    /**
     * Save a customer
     *
     * @param array $data input data
     * @param integer $id id of customer entry
     * @return CustomerEntity
     */
    public function save(array $data, $id = null)
    {
        // get mode
        $mode = (!$id) ? 'insert' : 'update';
        
        // get customer
        $customer = ($mode == 'insert') ? new CustomerEntity() 
                                       : $this->fetchSingleById($id);
        
        // check customer
        if (!$customer) {
            $this->setMessage('Kunde konnte nicht gefunden werden');
            return false;
        }
        
        // get filter and set data
        $filter = $this->getFilter();
        $filter->setData($data);
        
        // check for invalid data
        if (!$filter->isValid()) {
            $this->setMessage('Bitte Eingaben prüfen!');
            return false;
        }
        
        // get input hydrator
        $inputHydrator = new ArraySerializable();
        
        // get valid customer entity object
        $inputHydrator->hydrate($filter->getValues(), $customer);
        
        // get db hydrator
        $dbHydrator = new CustomerDbHydrator();
        
        // get save data
        $saveData = $dbHydrator->extract($customer);
        
        // insert new customer
        try {
            if ($mode == 'insert') {
                $result = $this->getTable()->insert($saveData);
                
                // get last insert value
                $id = $this->getTable()->getLastInsertValue();
            } else {
                $this->getTable()->update($saveData, array('id' => $id));
            }
        } catch (InvalidQueryException $e) {
            $this->setMessage('Kunde konnte nicht gespeichert werden');
            return false;
        }

        // reload customer
        $customer = $this->fetchSingleById($id);
        
        // set success message
        $this->setMessage('Kunde wurde gespeichert');
        
        // return customer
        return $customer;
    }

    /**
     * Delete existing customer
     *
     * @param integer $id customer id
     * @return boolean
     */
    public function delete($id)
    {
        // fetch customer entity
        $customer = $this->fetchSingleById($id);

        // check customer
        if (!$customer) {
            $this->setMessage('Kunde konnte nicht gefunden werden');
            return false;
        }

        // delete existing customer
        try {
            $result = $this->getTable()->delete(array('id' => $id));
        } catch (InvalidQueryException $e) {
            $this->setMessage('Kunde konnte nicht gelöscht werden');
            return false;
        }

        // set success message
        $this->setMessage('Kunde wurde gelöscht');

        // return result
        return true;
    }
}
