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
namespace Customer\Table;

use Customer\Entity\CustomerEntity;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Customer table
 * 
 * Table to represent a customer 
 * 
 * @package    Customer
 */
class CustomerTable extends TableGateway
{
    /**
     * Constructor
     *
     * @param Adapter                               $adapter database adapter
     * @param \Zend\Db\ResultSet\ResultSetInterface $resultSet
     */
    public function __construct(Adapter $adapter, ResultSetInterface $resultSet)
    {
        $table = 'customers';
    
        parent::__construct($table, $adapter, null, $resultSet);
    }
    
    /**
     * Fetch list of customers
     *
     * @param integer $country country code
     * @return CustomerEntity[]
     */
    public function fetchList($country = null)
    {
        $select = $this->getSql()->select();
        $select->order('lastname');
        
        if (!is_null($country)) {
            $select->where->equalTo('country', $country);
        }
        
        return $this->selectWith($select);
    }
    
    /**
     * Fetch single customer by id
     *
     * @param integer $id id of customer
     * @return CustomerEntity
     */
    public function fetchSingleById($id)
    {
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);
    
        return $this->selectWith($select)->current();
    }
}
