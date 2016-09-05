<?php

 /**
 * Implementation of IServiceProvider.
 *
 * PHP version 5.3
 *
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
use ODataProducer\Configuration\EntitySetRights;
require_once 'ODataProducer/IDataService.php';
require_once 'ODataProducer/IRequestHandler.php';
require_once 'ODataProducer/DataService.php';
require_once 'ODataProducer/IServiceProvider.php';
use ODataProducer\Configuration\DataServiceProtocolVersion;
use ODataProducer\Configuration\DataServiceConfiguration;
use ODataProducer\IServiceProvider;
use ODataProducer\DataService;

require_once 'CustomerMetadata.php';
require_once 'CustomerQueryProvider.php';
require_once 'CustomerDSExpressionProvider.php';

/**
 * CustomerDataService that implements IServiceProvider.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class CustomerDataService extends DataService implements IServiceProvider
{
    private $_CustomerMetadata = null;
    private $_CustomerQueryProvider = null;
    private $_CustomerExpressionProvider = null;
    
    /**
     * This method is called only once to initialize service-wide policies
     * 
     * @param DataServiceConfiguration &$config Data service configuration object
     * 
     * @return void
     */
    public function initializeService(DataServiceConfiguration &$config)
    {   
        $config->setEntitySetPageSize('*', 10);
        $config->setEntitySetAccessRule('*', EntitySetRights::ALL);
        $config->setAcceptCountRequests(true);
        $config->setAcceptProjectionRequests(true);
        $config->setMaxDataServiceVersion(DataServiceProtocolVersion::V3);
    }

    /**
     * Get the service like IDataServiceMetadataProvider, IDataServiceQueryProvider,
     * IDataServiceStreamProvider
     * 
     * @param String $serviceType Type of service IDataServiceMetadataProvider, 
     *                            IDataServiceQueryProvider,
     *                            IDataServiceStreamProvider
     * 
     * @see library/ODataProducer/ODataProducer.IServiceProvider::getService()
     * @return object
     */
    public function getService($serviceType)
    {
        
        if (($serviceType === 'IDataServiceMetadataProvider') 
            || ($serviceType === 'IDataServiceQueryProvider2') 
            || ($serviceType === 'IDataServiceStreamProvider')
        ) {
            if (is_null($this->_CustomerExpressionProvider)) {
                $this->_CustomerExpressionProvider = new CustomerDSExpressionProvider();
            }
        }
        
        if ($serviceType === 'IDataServiceMetadataProvider') {
            if (is_null($this->_CustomerMetadata)) {
                $this->_CustomerMetadata = CreateCustomerMetadata::create();
            }
            return $this->_CustomerMetadata;
        } else if ($serviceType === 'IDataServiceQueryProvider2') {
            if (is_null($this->_CustomerQueryProvider)) {
                $this->_CustomerQueryProvider = new CustomerQueryProvider();
            }
            return $this->_CustomerQueryProvider;
        } else if ($serviceType === 'IDataServiceStreamProvider') {
            return new CustomerStreamProvider();
        }
        return null;
    }
}

?>
