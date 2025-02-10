<?php
require_once 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;

function generateGuid(){
    return Uuid::uuid4()->toString();
}