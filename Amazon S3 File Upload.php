<?php

// First install composer
// composer require aws/aws-sdk-php


// Include the SDK using the composer autoloader
require 'vendor/autoload.php';
$filename_with_path = 'wp-content/uploads/'.$_FILES['file_data']['name'];
$sourceFilePath = $_FILES['file_data']['tmp_name'];
$s3 = new Aws\S3\S3Client([
	'region'  => '-- your region --',
	'version' => 'latest',
	'credentials' => [
	    'key'    => "-- access key id --",
	    'secret' => "-- secret access key --",
	]
]);

// Send a PutObject request and get the result object.
// $key = '-- your filename --';
$key = $filename_with_path;

$result = $s3->putObject([
	'Bucket' => '-- bucket name --',
	'Key'    => $key,
	'Body'   => 'this is the body!',
	//'SourceFile' => 'c:\samplefile.png' -- use this if you want to upload a file from a local location
	'SourceFile' => $sourceFilePath,
]);

// Print the body of the result by indexing into the result object.
var_dump($result);




// Example
// Include the SDK using the composer autoloader
/* 
require 'vendor/autoload.php';

$s3 = new Aws\S3\S3Client([
	'region'  => 'us-west-1',
	'version' => 'latest',
	'credentials' => [
	    'key'    => "AKIA4RSBVCVM6VIN5ISY",
	    'secret' => "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",
	]
]);

// Send a PutObject request and get the result object.
$key = 'Saud.jpg';

$result = $s3->putObject([
	'Bucket' => 'assets.modsanctum.net/wp-content',
	'Key'    => $key,
	'Body'   => 'this is the body!',
	'SourceFile' => 'C:\Users\Saud\Downloads\Saud.jpg'// -- use this if you want to upload a file from a local location
]);

// Print the body of the result by indexing into the result object.
echo "<pre>";
print_r($result);
echo "</pre>"; 
*/