<?php

/** 
 * Implementation of IDataServiceMetadataProvider.
 * 
 * PHP version 5.3
 * 
 * @category  Service
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
use ODataProducer\Providers\Metadata\ResourceStreamInfo;
use ODataProducer\Providers\Metadata\ResourceAssociationSetEnd;
use ODataProducer\Providers\Metadata\ResourceAssociationSet;
use ODataProducer\Common\NotImplementedException;
use ODataProducer\Providers\Metadata\Type\EdmPrimitiveType;
use ODataProducer\Providers\Metadata\ResourceSet;
use ODataProducer\Providers\Metadata\ResourcePropertyKind;
use ODataProducer\Providers\Metadata\ResourceProperty;
use ODataProducer\Providers\Metadata\ResourceTypeKind;
use ODataProducer\Providers\Metadata\ResourceType;
use ODataProducer\Common\InvalidOperationException;
use ODataProducer\Providers\Metadata\IDataServiceMetadataProvider;
require_once 'ODataProducer/Providers/Metadata/IDataServiceMetadataProvider.php';
use ODataProducer\Providers\Metadata\ServiceBaseMetadata;
//Begin Resource Classes

/**
 * address entity type.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class address
{
    //Edm.Int32
    public $addressID;
            
    //Edm.String
    public $street;
            
    //Edm.String
    public $number;
            
    //Edm.String
    public $state;
            
    //Edm.Int32
    public $postalcode;
            
    //Edm.Int32
    public $cityID;
            
    //Navigation Property Customer.city
    public $city;
    
    //Navigation Property Customer.customers
    public $customers;
    
}

/**
 * city entity type.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class city
{
    //Edm.Int32
    public $cityID;
            
    //Edm.String
    public $city;
            
    //Edm.Int32
    public $countryID;
            
    //Navigation Property Customer.country
    public $country;
    
    //Navigation Property Customer.addresses
    public $addresses;
    
}

/**
 * country entity type.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class country
{
    //Edm.Int32
    public $countryID;
            
    //Edm.String
    public $country;
            
    //Navigation Property Customer.cities
    public $cities;
    
}

/**
 * customer entity type.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class customer
{
    //Edm.Int32
    public $customerID;
            
    //Edm.String
    public $firstName;
            
    //Edm.String
    public $lastName;
            
    //Edm.String
    public $email;
            
    //Edm.Int32
    public $addressID;
            
    //Navigation Property Customer.address
    public $address;
    
}


/**
 * Create Customer metadata.
 * 
 * @category  Service
 * @package   Service_Customer
 * @author    Yash K. Kothari <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class CreateCustomerMetadata
{
    /**
     * create metadata
     * 
     * @return CustomerMetadata
     */
    public static function create()
    {
        $metadata = new ServiceBaseMetadata('CustomerEntities', 'Customer');
        
        //Register the entity (resource) type 'address'
        $addressEntityType = $metadata->addEntityType(
            new ReflectionClass('address'), 'address', 'Customer'
        );
        $metadata->addKeyProperty(
            $addressEntityType, 'addressID', EdmPrimitiveType::INT32
        );
        $metadata->addPrimitiveProperty(
            $addressEntityType, 'street', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $addressEntityType, 'number', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $addressEntityType, 'state', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $addressEntityType, 'postalcode', EdmPrimitiveType::INT32
        );
        $metadata->addPrimitiveProperty(
            $addressEntityType, 'cityID', EdmPrimitiveType::INT32
        );
        
        //Register the entity (resource) type 'city'
        $cityEntityType = $metadata->addEntityType(
            new ReflectionClass('city'), 'city', 'Customer'
        );
        $metadata->addKeyProperty(
            $cityEntityType, 'cityID', EdmPrimitiveType::INT32
        );
        $metadata->addPrimitiveProperty(
            $cityEntityType, 'city', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $cityEntityType, 'countryID', EdmPrimitiveType::INT32
        );
        
        //Register the entity (resource) type 'country'
        $countryEntityType = $metadata->addEntityType(
            new ReflectionClass('country'), 'country', 'Customer'
        );
        $metadata->addKeyProperty(
            $countryEntityType, 'countryID', EdmPrimitiveType::INT32
        );
        $metadata->addPrimitiveProperty(
            $countryEntityType, 'country', EdmPrimitiveType::STRING
        );
        
        //Register the entity (resource) type 'customer'
        $customerEntityType = $metadata->addEntityType(
            new ReflectionClass('customer'), 'customer', 'Customer'
        );
        $metadata->addKeyProperty(
            $customerEntityType, 'customerID', EdmPrimitiveType::INT32
        );
        $metadata->addPrimitiveProperty(
            $customerEntityType, 'firstName', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $customerEntityType, 'lastName', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $customerEntityType, 'email', EdmPrimitiveType::STRING
        );
        $metadata->addPrimitiveProperty(
            $customerEntityType, 'addressID', EdmPrimitiveType::INT32
        );
        
        $addressesResourceSet = $metadata->addResourceSet(
            'addresses', $addressEntityType
        );
        $citiesResourceSet = $metadata->addResourceSet(
            'cities', $cityEntityType
        );
        $countriesResourceSet = $metadata->addResourceSet(
            'countries', $countryEntityType
        );
        $customersResourceSet = $metadata->addResourceSet(
            'customers', $customerEntityType
        );

        //Register the assoications (navigations)
        $metadata->addResourceReferenceProperty(
            $addressEntityType, 'city', $citiesResourceSet
        );
        $metadata->addResourceSetReferenceProperty(
            $cityEntityType, 'addresses', $addressesResourceSet
        );
        $metadata->addResourceReferenceProperty(
            $cityEntityType, 'country', $countriesResourceSet
        );
        $metadata->addResourceSetReferenceProperty(
            $countryEntityType, 'cities', $citiesResourceSet
        );
        $metadata->addResourceReferenceProperty(
            $customerEntityType, 'address', $addressesResourceSet
        );
        $metadata->addResourceSetReferenceProperty(
            $addressEntityType, 'customers', $customersResourceSet
        );
        
        return $metadata;
    }
}
?>
