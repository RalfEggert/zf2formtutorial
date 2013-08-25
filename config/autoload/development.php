<?php
/**
 * Zend Framework 2 Beispiel
 * 
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.zendframeworkbuch.de/
 */

/**
 * Local configuration
 * 
 * @package    Application
 */
return array(
    'db' => array(
        'database' => APPLICATION_ROOT . '/data/db/customer.db',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Application\Db\ProfilingAdapterFactory',
        ),
    ),
);
