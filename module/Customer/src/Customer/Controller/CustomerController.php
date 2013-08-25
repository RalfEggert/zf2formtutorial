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
namespace Customer\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Form\CustomerForm;
use Customer\Service\CustomerService;

/**
 * Customer customer controller
 * 
 * Handles the customer pages
 * 
 * @package    Customer
 */
class CustomerController extends AbstractActionController
{
    /**
     * @var CustomerForm
     */
    protected $form;
    
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * set the customer service
     *
     * @param \Customer\Service\CustomerService $customerService
     *
     * @return $this
     */
    public function setCustomerService(CustomerService $customerService)
    {
        $this->customerService = $customerService;

        return $this;
    }
    
    /**
     * Get the customer service
     * 
     * @return CustomerService
     */
    public function getCustomerService()
    {
        return $this->customerService;
    }

    /**
     * set the customer form
     *
     * @param \Customer\Form\CustomerForm $form
     *
     * @return $this
     */
    public function setCustomerForm(CustomerForm $form)
    {
        $this->form = $form;
        
        return $this;
    }
    
    /**
     * Get the customer form
     * 
     * @return CustomerForm
     */
    public function getCustomerForm()
    {
        return $this->form;
    }
    
    /**
     * Handle index page
     */
    public function indexAction()
    {
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute('customer'),
            true
        );

        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;

            // check PRG for redirect to process
        } elseif ($prg !== false) {

            // create with redirected data
            $customer = $this->getCustomerService()->save($prg);

            // check customer
            if ($customer) {
                // add messages to flash messenger
                if ($this->getCustomerService()->getMessage()) {
                    $this->flashMessenger()->addMessage(
                        $this->getCustomerService()->getMessage()
                    );
                }

                // Redirect to created page
                return $this->redirect()->toRoute(
                    'customer/action', array(
                        'action' => 'show', 'id' => $customer->getId()
                    )
                );
            }
        }

        // get form
        $form = $this->getCustomerForm();
        $form->setMessages($this->getCustomerService()->getFilter()->getMessages());

        // set values from GET request
        if ($prg != false) {
            $form->setData($prg);
        }

        // add messages to flash messenger
        if ($this->getCustomerService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getCustomerService()->getMessage()
            );
        }

        // no post or registration unsuccessful
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    /**
     * Handle show page
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');
        
        if (!$id) {
            return $this->redirect()->toRoute('customer');
        }
        
        $customerEntity = $this->getCustomerService()->fetchSingleById($id);
        
        if (!$customerEntity) {
            return $this->redirect()->toRoute('customer');
        }
        
        return new ViewModel(array(
            'customerEntity' => $customerEntity,
        ));
    }
}
