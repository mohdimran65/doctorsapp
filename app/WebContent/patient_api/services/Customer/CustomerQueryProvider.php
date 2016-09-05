<?php  	
 

	/** 
	 * Implementation of IDataServiceQueryProvider.
	 * 
	 * PHP version 5.3
	 * 
	 * @category  Service
	 * @package   Customer;
	 * @author    MySQLConnector <odataphpproducer_alias@microsoft.com>
	 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
	 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
	 * @version   SVN: 1.0
	 * @link      http://odataphpproducer.codeplex.com
	 */     
	use ODataProducer\UriProcessor\ResourcePathProcessor\SegmentParser\KeyDescriptor;
	use ODataProducer\Providers\Metadata\ResourceSet;
	use ODataProducer\Providers\Metadata\ResourceProperty;
	use ODataProducer\Providers\Query\IDataServiceQueryProvider2;
	require_once "CustomerMetadata.php";
	require_once "ODataProducer/Providers/Query/IDataServiceQueryProvider2.php";
	
	/** The name of the database for Customer*/
	define('DB_NAME', "customer");
	/** MySQL database username */
	define('DB_USER', "root");
	/** MySQL database password */
	define('DB_PASSWORD', "");
	/** MySQL hostname */
	define('DB_HOST', "127.0.0.1");
			
   			
	/**
     * CustomerQueryProvider implemetation of IDataServiceQueryProvider2.
	 * @category  Service
	 * @package   Customer;
	 * @author    MySQLConnector <odataphpproducer_alias@microsoft.com>
	 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
	 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
	 * @version   Release: 1.0
	 * @link      http://odataphpproducer.codeplex.com
	 */
	class CustomerQueryProvider implements IDataServiceQueryProvider2
	{
    	/**
     	 * Handle to connection to Database     
     	 */
    	private $_connectionHandle = null;

      private $_expressionProvider = null;

    	/**
     	 * Constructs a new instance of CustomerQueryProvider
     	 * 
     	 */
	    public function __construct()
    	{
        	$this->_connectionHandle = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, true);
        	if ( $this->_connectionHandle ) {
        		mysql_select_db(DB_NAME, $this->_connectionHandle);
        	} else {             
            	die(mysql_error());
        	} 
    	}

    	/**
	   	 * Library will use this function to check whether library has to
	     * apply orderby, skip and top.
	     * Note: Library will not delegate $select/$expand operation to IDSQP2
	     * implementation, they will always handled by Library.
	     * 
	     * @return Boolean True If user want library to apply the query options
	     *                 False If user is going to take care of orderby, skip
	     *                 and top options
	     */
	    public function canApplyQueryOptions()
	    {
	    	return true;
	    }

	    /**
    	 * Gets collection of entities belongs to an entity set
     	 * 
     	 * @param ResourceSet $resourceSet The entity set whose entities needs to be fetched
     	 * 
     	 * @return array(Object)
     	 */
    	public function getResourceSet(ResourceSet $resourceSet, $filterOption = null, 
        	$select=null, $orderby=null, $top=null, $skip=null)
    	{   
        	$resourceSetName =  $resourceSet->getName();
			 
        	if($resourceSetName === 'addresses')
        	{
        		$resourceSetName = 'address';
        	}	
       				 
        	if($resourceSetName === 'cities')
        	{
        		$resourceSetName = 'city';
        	}	
       				 
        	if($resourceSetName === 'countries')
        	{
        		$resourceSetName = 'country';
        	}	
       				 
        	if($resourceSetName === 'customers')
        	{
        		$resourceSetName = 'customer';
        	}	
       				 
			if( $resourceSetName !== 'address'
	        			
	    	and $resourceSetName !== 'city'
	        			
	    	and $resourceSetName !== 'country'
	        			
	    	and $resourceSetName !== 'customer'
	        			)	       		
        	{
        		die('(CustomerQueryProvider) Unknown resource set ' . $resourceSetName);
        	}       	
        	$query = "SELECT * FROM $resourceSetName";
	        if ($filterOption != null) {
    	        $query .= ' WHERE ' . $filterOption;
        	}
        	$stmt = mysql_query($query);
        	if ($stmt === false) {
            	die(print_r(mysql_error(), true));
        	}

        	$returnResult = array();
        	switch ($resourceSetName) {
        		
				case 'address':
	        		
	        		$returnResult = $this->_serializeaddresses($stmt);
       				break;
				
				case 'city':
	        		
	        		$returnResult = $this->_serializecities($stmt);
       				break;
				
				case 'country':
	        		
	        		$returnResult = $this->_serializecountries($stmt);
       				break;
				
				case 'customer':
	        		
	        		$returnResult = $this->_serializecustomers($stmt);
       				break;
				
        	}
        	mysql_free_result($stmt);
        	return $returnResult;        
		} 


	    /**
    	 * Gets an entity instance from an entity set identifed by a key
	     * 
    	 * @param ResourceSet   $resourceSet   The entity set from which 
	     *                                     an entity needs to be fetched
    	 * @param KeyDescriptor $keyDescriptor The key to identify the entity to be fetched
     	 * 
	     * @return Object/NULL Returns entity instance if found else null
    	 */
	    public function getResourceFromResourceSet(ResourceSet $resourceSet, KeyDescriptor $keyDescriptor)
    	{   
        	$resourceSetName =  $resourceSet->getName();
    	     
        	if($resourceSetName === 'addresses')
        	{
        		$resourceSetName = 'address';
        	}	
       				 
        	if($resourceSetName === 'cities')
        	{
        		$resourceSetName = 'city';
        	}	
       				 
        	if($resourceSetName === 'countries')
        	{
        		$resourceSetName = 'country';
        	}	
       				 
        	if($resourceSetName === 'customers')
        	{
        		$resourceSetName = 'customer';
        	}	
       				
    		if( $resourceSetName !== 'address'
	        			
	    	and $resourceSetName !== 'city'
	        			
	    	and $resourceSetName !== 'country'
	        			
	    	and $resourceSetName !== 'customer'
	        			)	       		
        	{
	        	die('(CustomerQueryProvider) Unknown resource set ' . $resourceSetName);
    	    }
        	$namedKeyValues = $keyDescriptor->getValidatedNamedValues();
        	$condition = null;
        	foreach ($namedKeyValues as $key => $value) {
	            $condition .= $key . ' = ' . $value[0] . ' and ';
    	    }
	
    	    $len = strlen($condition);
        	$condition = substr($condition, 0, $len - 5); 
	        $query = "SELECT * FROM $resourceSetName WHERE $condition";
    	    $stmt = mysql_query($query);
        	if ($stmt === false) {
            	die(print_r(mysql_error(), true));
        	}

        	//If resource not found return null to the library
        	if (!mysql_num_rows($stmt)) {
            	return null;
        	}

	        $result = null;
        	while ( $record = mysql_fetch_array($stmt, MYSQL_ASSOC)) {
    	    	switch ($resourceSetName) {
    	    		
				case 'address':
	        		
	        		$returnResult = $this->_serializeaddress($record);
       				break;
				
				case 'city':
	        		
	        		$returnResult = $this->_serializecity($record);
       				break;
				
				case 'country':
	        		
	        		$returnResult = $this->_serializecountry($record);
       				break;
				
				case 'customer':
	        		
	        		$returnResult = $this->_serializecustomer($record);
       				break;
				
        		}
        	}	
        	mysql_free_result($stmt);
        	return $returnResult;        
    	}
    	
	    /**
    	 * Gets a related entity instance from an entity set identifed by a key
	     * 
    	 * @param ResourceSet      $sourceResourceSet    The entity set related to
	     *                                               the entity to be fetched.
    	 * @param object           $sourceEntityInstance The related entity instance.
     	 * @param ResourceSet      $targetResourceSet    The entity set from which
     	 *                                               entity needs to be fetched.
     	 * @param ResourceProperty $targetProperty       The metadata of the target 
     	 *                                               property.
     	 * @param KeyDescriptor    $keyDescriptor        The key to identify the entity 
     	 *                                               to be fetched.
     	 * 
     	 * @return Object/NULL Returns entity instance if found else null
     	 */
    	public function  getResourceFromRelatedResourceSet(ResourceSet $sourceResourceSet, 
        	$sourceEntityInstance, 
        	ResourceSet $targetResourceSet,
        	ResourceProperty $targetProperty,
        	KeyDescriptor $keyDescriptor
    	) {
        	$result = array();
        	$srcClass = get_class($sourceEntityInstance);
        	$navigationPropName = $targetProperty->getName();
        	$key = null;
        	foreach ($keyDescriptor->getValidatedNamedValues() as $keyName => $valueDescription) {
	            $key = $key . $keyName . '=' . $valueDescription[0] . ' and ';
    	    }
        	$key = rtrim($key, ' and ');
       		if($srcClass === 'address')
			{		
				if($navigationPropName === 'customers') 
				{			
							
					$query = "SELECT * FROM customer WHERE addressID = '$sourceEntityInstance->addressID' and $key";
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializecustomers($stmt);
				}
									
				else {
					die('address does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'city')
			{		
				if($navigationPropName === 'addresses') 
				{			
							
					$query = "SELECT * FROM address WHERE cityID = '$sourceEntityInstance->cityID' and $key";
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializeaddresses($stmt);
				}
									
				else {
					die('city does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'country')
			{		
				if($navigationPropName === 'cities') 
				{			
							
					$query = "SELECT * FROM city WHERE countryID = '$sourceEntityInstance->countryID' and $key";
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializecities($stmt);
				}
									
				else {
					die('country does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'customer')
			{		
				
			}	
			
       		return empty($result) ? null : $result[0];	
		}
		
    
	    /**
    	 * Get related resource set for a resource
     	* 
     	* @param ResourceSet      $sourceResourceSet    The source resource set
     	* @param mixed            $sourceEntityInstance The resource
     	* @param ResourceSet      $targetResourceSet    The resource set of 
     	*                                               the navigation property
     	* @param ResourceProperty $targetProperty       The navigation property to be 
     	*                                               retrieved
     	*                                               
     	* @return array(Objects)/array() Array of related resource if exists, if no 
     	*                                related resources found returns empty array
     	*/
    	public function  getRelatedResourceSet(ResourceSet $sourceResourceSet, 
        	$sourceEntityInstance, 
        	ResourceSet $targetResourceSet,
        	ResourceProperty $targetProperty,
	        $filterOption = null,
    	    $select=null, $orderby=null, $top=null, $skip=null
    	) {
	        $result = array();
    	    $srcClass = get_class($sourceEntityInstance);
	        $navigationPropName = $targetProperty->getName();
       		if($srcClass === 'address')
			{		
				if($navigationPropName === 'customers') 
				{			
							
					$query = "SELECT * FROM customer WHERE addressID = '$sourceEntityInstance->addressID'";
	                if ($filterOption != null) {
    	                $query .= ' AND ' . $filterOption;
        	        }
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializecustomers($stmt);
				}
									
				else {
					die('address does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'city')
			{		
				if($navigationPropName === 'addresses') 
				{			
							
					$query = "SELECT * FROM address WHERE cityID = '$sourceEntityInstance->cityID'";
	                if ($filterOption != null) {
    	                $query .= ' AND ' . $filterOption;
        	        }
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializeaddresses($stmt);
				}
									
				else {
					die('city does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'country')
			{		
				if($navigationPropName === 'cities') 
				{			
							
					$query = "SELECT * FROM city WHERE countryID = '$sourceEntityInstance->countryID'";
	                if ($filterOption != null) {
    	                $query .= ' AND ' . $filterOption;
        	        }
			        $stmt = mysql_query($query);
        			if ($stmt === false) {            
        				die(print_r(mysql_error(), true));
	    			}
	    			$result = $this->_serializecities($stmt);
				}
									
				else {
					die('country does not have navigation porperty with name: ' . $navigationPropName);
				}
				
			}	
			
			else if($srcClass === 'customer')
			{		
				
			}	
			
       		return $result;	        
    	}    
    	
	    /**
    	 * Get related resource for a resource
     	* 
     	* @param ResourceSet      $sourceResourceSet    The source resource set
     	* @param mixed            $sourceEntityInstance The source resource
     	* @param ResourceSet      $targetResourceSet    The resource set of 
     	*                                               the navigation property
     	* @param ResourceProperty $targetProperty       The navigation property to be 
     	*                                               retrieved
     	* 
     	* @return Object/null The related resource if exists else null
     	*/
    	public function getRelatedResourceReference(ResourceSet $sourceResourceSet, 
        	$sourceEntityInstance, 
        	ResourceSet $targetResourceSet,
        	ResourceProperty $targetProperty
    	) {
        	$result = null;
        	$srcClass = get_class($sourceEntityInstance);
        	$navigationPropName = $targetProperty->getName();
			if($srcClass==='address')
			{
					 if($navigationPropName === 'city')
				{
					if (empty($sourceEntityInstance->cityID))
					{
                		$result = null;
					} else {
						$query = "SELECT * FROM city WHERE cityID = '$sourceEntityInstance->cityID'";
						$stmt = mysql_query($query);
						if ($stmt === false) {
							die(print_r(mysql_error(), true));
						}
						if (!mysql_num_rows($stmt)) {
							$result =  null;
						}
						$result = $this->_serializecity(mysql_fetch_array($stmt, MYSQL_ASSOC));
					}
				}
								
				else {
					die('address does not have navigation porperty with name: ' . $navigationPropName);
				}
											
			}
				
			else if($srcClass==='city')
			{
					 if($navigationPropName === 'country')
				{
					if (empty($sourceEntityInstance->countryID))
					{
                		$result = null;
					} else {
						$query = "SELECT * FROM country WHERE countryID = '$sourceEntityInstance->countryID'";
						$stmt = mysql_query($query);
						if ($stmt === false) {
							die(print_r(mysql_error(), true));
						}
						if (!mysql_num_rows($stmt)) {
							$result =  null;
						}
						$result = $this->_serializecountry(mysql_fetch_array($stmt, MYSQL_ASSOC));
					}
				}
								
				else {
					die('city does not have navigation porperty with name: ' . $navigationPropName);
				}
											
			}
				
			else if($srcClass==='country')
			{
										
			}
				
			else if($srcClass==='customer')
			{
					 if($navigationPropName === 'address')
				{
					if (empty($sourceEntityInstance->addressID))
					{
                		$result = null;
					} else {
						$query = "SELECT * FROM address WHERE addressID = '$sourceEntityInstance->addressID'";
						$stmt = mysql_query($query);
						if ($stmt === false) {
							die(print_r(mysql_error(), true));
						}
						if (!mysql_num_rows($stmt)) {
							$result =  null;
						}
						$result = $this->_serializeaddress(mysql_fetch_array($stmt, MYSQL_ASSOC));
					}
				}
								
				else {
					die('customer does not have navigation porperty with name: ' . $navigationPropName);
				}
											
			}
				
			return $result;
		}
			
		
		/**
    	 * Serialize the sql result array into address objects
		 * 	
     	 * @param array(array) $result result of the sql query
     	 * 
     	 * @return array(Object)
     	 */
    	private function _serializeaddresses($result)
    	{
        	$addresses = array();
        	while ($record = mysql_fetch_array($result, MYSQL_ASSOC)) {         
            	$addresses[] = $this->_serializeaddress($record);
        	}
        	return $addresses;
    	}
    	
    	/**
    	 * Serialize the sql row into address object
	     * 
    	 * @param array $record each row of address
	     * 
    	 * @return Object
	     */
	    private function _serializeaddress($record)
    	{
        	$address = new address();
        	
			$address->addressID = $record['addressID'];							
								
			$address->street = $record['street'];							
								
			$address->number = $record['number'];							
								
			$address->state = $record['state'];							
								
			$address->postalcode = $record['postalcode'];							
								
			$address->cityID = $record['cityID'];							
								
    		return $address;
		}										
			
		/**
    	 * Serialize the sql result array into city objects
		 * 	
     	 * @param array(array) $result result of the sql query
     	 * 
     	 * @return array(Object)
     	 */
    	private function _serializecities($result)
    	{
        	$cities = array();
        	while ($record = mysql_fetch_array($result, MYSQL_ASSOC)) {         
            	$cities[] = $this->_serializecity($record);
        	}
        	return $cities;
    	}
    	
    	/**
    	 * Serialize the sql row into city object
	     * 
    	 * @param array $record each row of city
	     * 
    	 * @return Object
	     */
	    private function _serializecity($record)
    	{
        	$city = new city();
        	
			$city->cityID = $record['cityID'];							
								
			$city->city = $record['city'];							
								
			$city->countryID = $record['countryID'];							
								
    		return $city;
		}										
			
		/**
    	 * Serialize the sql result array into country objects
		 * 	
     	 * @param array(array) $result result of the sql query
     	 * 
     	 * @return array(Object)
     	 */
    	private function _serializecountries($result)
    	{
        	$countries = array();
        	while ($record = mysql_fetch_array($result, MYSQL_ASSOC)) {         
            	$countries[] = $this->_serializecountry($record);
        	}
        	return $countries;
    	}
    	
    	/**
    	 * Serialize the sql row into country object
	     * 
    	 * @param array $record each row of country
	     * 
    	 * @return Object
	     */
	    private function _serializecountry($record)
    	{
        	$country = new country();
        	
			$country->countryID = $record['countryID'];							
								
			$country->country = $record['country'];							
								
    		return $country;
		}										
			
		/**
    	 * Serialize the sql result array into customer objects
		 * 	
     	 * @param array(array) $result result of the sql query
     	 * 
     	 * @return array(Object)
     	 */
    	private function _serializecustomers($result)
    	{
        	$customers = array();
        	while ($record = mysql_fetch_array($result, MYSQL_ASSOC)) {         
            	$customers[] = $this->_serializecustomer($record);
        	}
        	return $customers;
    	}
    	
    	/**
    	 * Serialize the sql row into customer object
	     * 
    	 * @param array $record each row of customer
	     * 
    	 * @return Object
	     */
	    private function _serializecustomer($record)
    	{
        	$customer = new customer();
        	
			$customer->customerID = $record['customerID'];							
								
			$customer->firstName = $record['firstName'];							
								
			$customer->lastName = $record['lastName'];							
								
			$customer->email = $record['email'];							
								
			$customer->addressID = $record['addressID'];							
								
    		return $customer;
		}										
			
    /**
    * The destructor
    */
    public function __destruct()
    {
    if ($this->_connectionHandle) {
    mysql_close($this->_connectionHandle);
    }
    }

    public function getExpressionProvider()
    {
    if (is_null($this->_expressionProvider)) {
    $this->_expressionProvider = new CustomerDSExpressionProvider();
    }

    return $this->_expressionProvider;
    }
    }

?>