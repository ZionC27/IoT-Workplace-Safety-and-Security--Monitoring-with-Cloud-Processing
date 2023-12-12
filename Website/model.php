<!-- 
require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\DynamoDb\DynamoDbClient;
use Aws\Exception\AwsException;

// Create a DynamoDB client
$ddb = new DynamoDbClient([
    'region' => 'ca-central-1',
    'version' => 'latest',
    'credentials' => [
        'key'    => 'access key',
        'secret' => 'secret key',
    ],
]);

function signUpNewUser($u, $p, $e)
{
    global $ddb;

    $current_date = date("Ymd");

    $params = [
        'TableName' => 'FormUsers',
        'Item' => [
            'Id' => ['S' => uniqid()], 
            'Username' => ['S' => $u],
            'Password' => ['S' => $p],
            'Email' => ['S' => $e],
            'RegistrationDate' => ['S' => $current_date],
        ],
    ];

    try {
        $result = $ddb->putItem($params);

        return true;
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return false;
    }
}


function isUserValid($u, $p) {
global $ddb;
    
$params = [
    'TableName' => 'FormUsers',
];

try {
    $result = $ddb->scan($params);
    
    if ($result['Count'] > 0) {

        foreach ($result['Items'] as $item) {
            $username = $item['Username']['S'];
            $password = $item['Password']['S'];
           
            if ($u === $username && $p === $password) {
                return true;
            }
        }
        return false;
    }
        
} catch (AwsException $e) {
    error_log($e->getMessage());
    return "error";
}
}



function doesUserExist($u)
{
    global $ddb;
        
    $params = [
        'TableName' => 'FormUsers',
    ];

try {
    $result = $ddb->scan($params);
    if ($result['Count'] > 0) {

        foreach ($result['Items'] as $item) {
            $username = $item['Username']['S'];           
            if ($u === $username) {
                return true;
            }
        }
            return false;
    }
        
} catch (AwsException $e) {
    error_log($e->getMessage());
    return false;
}
}


?> -->

<?php
require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\DynamoDb\DynamoDbClient;
use Aws\Exception\AwsException;

// Create a DynamoDB client
$ddb = new DynamoDbClient([
    'region' => 'ca-central-1',
    'version' => 'latest',
    'credentials' => [
        'key'    => 'key',
        'secret' => 'secret',
    ],
]);

function signUpNewUser($u, $p, $e)
{
    global $ddb;

    $current_date = date("Ymd");

    // Hash the password
    $hashed_password = password_hash($p, PASSWORD_DEFAULT);

    $params = [
        'TableName' => 'FormUsers',
        'Item' => [
            'Id' => ['S' => uniqid()],
            'Username' => ['S' => $u],
            'Password' => ['S' => $hashed_password], // Store the hashed password
            'Email' => ['S' => $e],
            'RegistrationDate' => ['S' => $current_date],
        ],
    ];

    try {
        $result = $ddb->putItem($params);

        return true;
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function isUserValid($u, $p) {
    global $ddb;

    $params = [
        'TableName' => 'FormUsers',
    ];

    try {
        $result = $ddb->scan($params);

        foreach ($result['Items'] as $item) {
            $username = $item['Username']['S'];
            $hashed_password = $item['Password']['S'];

            if ($u === $username && password_verify($p, $hashed_password)) {
                return true;
            }
        }

        return false; 
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function doesUserExist($u)
{
    global $ddb;

    $params = [
        'TableName' => 'FormUsers',
    ];

    try {
        $result = $ddb->scan($params);

        foreach ($result['Items'] as $item) {
            $username = $item['Username']['S'];
            if ($u === $username) {
                return true;
            }
        }

        return false; // Return false if user not found
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return false;
    }
}
?>
