<?php

/**
 * ES3 class file.
 *
 * ES3 is a wrapper for the excellent S3.php class provided by Donovan Sch�nknecht (@link http://undesigned.org.za/2007/10/22/amazon-s3-php-class)
 * This wrapper contains minimal functionality as there is only so much I want to allow access to from the Yii public end
 *
 * @version 0.1
 *
 * @uses CFile
 * @author Dana Luther (dana.luther@gmail.com)
 * @copyright Copyright &copy; 2010 Dana Luther
 */
Yii::import('ext.s3.S3');


 class ES3 extends CApplicationComponent
{

	private $_s3;
	public $aKey; // AWS Access key
	public $sKey; // AWS Secret key	
	public $bucket;
	public $lastError="";

       
	private function getInstance(){
		if ($this->_s3 === NULL)
			$this->connect();
		return $this->_s3;
	}

	/**
	 * Instance the S3 object
	 */
	public function connect()
	{
		if ( $this->aKey === NULL || $this->sKey === NULL )
			throw new CException('S3 Keys are not set.');
			
		$this->_s3 = new S3($this->aKey,$this->sKey);
	}
	
	/**
	 * @param string $original File to upload - can be any valid CFile filename
	 * @param string $uploaded Name of the file on destination -- can include directory separators
	 */
	public function upload( $original, $uploaded="", $bucket="" )
	{
		
		
		$s3 = $this->getInstance();
		
		if( $bucket == "" )
		{
			$bucket = $this->bucket;
		}
		
		if ($bucket === NULL || trim($bucket) == "")
		{
			throw new CException('Bucket param cannot be empty');
		}
		
		$file = Yii::app()->file->set($original);
	
		if(!$file->exists)
			throw new CException('Origin file not found');
		
		$fs1 = $file->size;
		
		if ( !$fs1 )
		{
			$this->lastError = "Attempted to upload empty file.";
			return false;
		}
	
		if (trim($uploaded) == ""){
			$uploaded = $original;
		}
		
		//if (!$s3->putObject($s3->inputResource(fopen($file->getRealPath(), 'r'), $fs1), $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		echo $file->getRealPath();
               
		//if (!$s3->putObject($s3->inputResource( fopen($file->getRealPath(), 'rb'), $fs1), $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		if (!$s3->putObjectFile( $original, $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		{
			$this->lastError = "Unable to upload file.";
			return false;
		}
		return true;
	}
	
        
        
	// Testing connection :p
	public function buckets()
	{
		$s3 = $this->getInstance();
		return $s3->listBuckets();
	}
	
        
	// Passthru function for basic functions
	public function call( $func )
	{
		$s3 = $this->getInstance();
		return $s3->$func();
	}
        
        
        /**
	* Delete an object
	*
	* @param string $bucket Bucket name
	* @param string $uri Object URI
	* @return boolean
	*/
        
        public function deleteObject($bucket, $uri){
            $s3 = $this->getInstance();
            
            if( $bucket == "" )
            {
                    $bucket = $this->bucket;
            }

            if ($bucket === NULL || trim($bucket) == "")
            {
                    throw new CException('Bucket param cannot be empty');
            }
            
            if($uri != "" ){
                
                return $s3->deleteObject($bucket, $uri);
                
            }else{
                $this->lastError = "URI is empty.";
            }
            
        }
        
        /*
	* Get contents for a bucket*/
        public function getBucket($bucket){
            if($bucket !="" )
            {
                 $s3 = $this->getInstance();    
                 
                 return $s3->getBucket($bucket);
            }else{
                
                $this->lastError = "Bucket is empty.";
            }             
        }
        
        /**
	* Put a bucket
	*
	* @param string $bucket Bucket name
	* @param constant $acl ACL flag
	* @param string $location Set as "EU" to create buckets hosted in Europe
	* @return boolean
	*/
        public function putBucket($bucket, $acl = self::ACL_PRIVATE, $location = false){
            if($bucket !="" )
            {
                 $s3 = $this->getInstance();             
                return $s3->putBucket($bucket, $acl, $location);   
            }else{
                
                $this->lastError = "Bucket is empty.";
            }             
        }
        
        
        /**
	* Delete an empty bucket
	*
	* @param string $bucket Bucket name
	* @return boolean
	*/
        
        public function deleteBucket($bucket){
            
            $s3 = $this->getInstance();
            
            if( $bucket != ""){
                return $s3->deleteBucket($bucket);
            }else{
                $this->lastError = "Can not delete.";
            }
            
        }
        
        
        /**
	* Get an object
	*
	* @param string $bucket Bucket name
	* @param string $uri Object URI
	* @param mixed $saveTo Filename or resource to write to
	* @return mixed
	*/
        public function getObject($bucket, $uri, $saveTo = false ){
             if($bucket != "" && $uri != ""){
                  $s3 = $this->getInstance();
                  return $s3->getObject($bucket, $uri, $saveTo) ;
             }else{
               $this->lastError = "Bucket is empty.";
           }
           return false;
           
        }
        
        
        /**
	* Get object information
	*
	* @param string $bucket Bucket name
	* @param string $uri Object URI
	* @param boolean $returnInfo Return response information
	* @return mixed | false
	*/
        
       public function getObjectInfo($bucket, $uri, $returnInfo = true){
           if($bucket != "" && $uri != "")
           {
               $s3 = $this->getInstance();
                
               return $s3->getObjectInfo($bucket, $uri, $returnInfo);
           }else{
               $this->lastError = "Bucket is empty.";
           }
           return false;
           
       }
       /**
	* Copy an object
	*
	* @param string $bucket Source bucket name
	* @param string $uri Source object URI
	* @param string $bucket Destination bucket name
	* @param string $uri Destination object URI
	* @param constant $acl ACL constant
	* @param array $metaHeaders Optional array of x-amz-meta-* headers
	* @param array $requestHeaders Optional array of request headers (content type, disposition, etc.)
	* @return mixed | false
	*/
       
       public function copyObject($srcBucket, $srcUri, $bucket, $uri, $acl = self::ACL_PRIVATE, $metaHeaders = array(), $requestHeaders = array()) {
           $s3 = $this->getInstance();
           return $s3->copyObject($srcBucket, $srcUri, $bucket, $uri, $acl, $metaHeaders, $requestHeaders);
           
       }
       
       
       public function setBucketLogging($bucket, $targetBucket, $targetPrefix = null){
           $s3 = $this->getInstance();
           return $s3->setBucketLogging($bucket, $targetBucket, $targetPrefix);
       }
       
       
       public function getBucketLogging($bucket){
           if($bucket != ""){
                $s3 = $this->getInstance();
                return $s3->getBucketLogging($bucket);
           }else{
               $this->lastError = "Bucket is empty.";
           }
           return false;
       }
       
       /**
	* Get a bucket's location
	*
	* @param string $bucket Bucket name
	* @return string | false
	*/
       
       public function getBucketLocation($bucket){
            if($bucket != ""){
                $s3 = $this->getInstance();
                return $s3->getBucketLocation($bucket);
           }else{
               $this->lastError = "Bucket is empty.";
           }
           return false;
       }
       
       /**
	* Create a CloudFront distribution
	*
	* @param string $bucket Bucket name
	* @param boolean $enabled Enabled (true/false)
	* @param array $cnames Array containing CNAME aliases
	* @param string $comment Use the bucket name as the hostname
	* @return array | false
	*/
       
       public function createDistribution($bucket, $enabled = true, $cnames = array(), $comment = '') {
           
           $s3 = $this->getInstance();
           return $s3->createDistribution($bucket, $enabled, $cnames, $comment);
       }
       
       /**
	* Get CloudFront distribution info
	*
	* @param string $distributionId Distribution ID from listDistributions()
	* @return array | false
	*/
       
       public function getDistribution($distributionId) {
           if($distributionId != ""){
               $s3 = $this->getInstance();
               return $s3->getDistribution($distributionId);
           }else{
               $this->lastError = "Distribution id is empty.";
           }
           return false;
           
       }
       
       /**
	* Update a CloudFront distribution
	*
	* @param array $dist Distribution array info identical to output of getDistribution()
	* @return array | false
	*/
       public function updateDistribution($dist){
           if(!empty($dist)){
                $s3 = $this->getInstance();
               return $s3->updateDistribution($dist);
           }else{
               $this->lastError = "Distribution is empty.";
           }
           return false;
           
       }
       
      /**
	* Delete a CloudFront distribution
	*
	* @param array $dist Distribution array info identical to output of getDistribution()
	* @return boolean
	*/ 
       public function deleteDistribution($dist){
           
           if(!empty($dist)){
                $s3 = $this->getInstance();
               return $s3->deleteDistribution($dist);
           }else{
               $this->lastError = "Distribution is empty.";
               
           }
           return false;
       }
       /**
	* Get a list of CloudFront distributions
	*
	* @return array
	*/
       public function listDistributions() {
           
           $s3 = $this->getInstance();
           return $s3->listDistributions;
       }

}
?>