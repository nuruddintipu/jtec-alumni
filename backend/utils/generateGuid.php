<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Ramsey\Uuid\Uuid;

function generateGuid(): string
{
    return Uuid::uuid4()->toString();
}