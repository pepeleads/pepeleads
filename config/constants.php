<?php

$key=[
    'DB_CONNECTION'=>'mysql',
    'DB_HOST'=>'127.0.0.1',
    'DB_PORT'=>'3306',
  
    'MAIL_MAILER'=>'smtp',
    'MAIL_HOST'=>'pepeleads.com',
    'MAIL_PORT'=>'465',
    'MAIL_USERNAME'=>'no-reply@pepeleads.com',
    'MAIL_PASSWORD'=>'a!]KMZ&QE1P2',
    'MAIL_ENCRYPTION'=>'ssl',
    'MAIL_FROM_ADDRESS'=>'no-reply@pepeleads.com',
    'MAIL_FROM_NAME'=>'PepeLeads',
];

$host=env('APP_URL');
if($host=='http://offershowme.local'){
    $key['DB_DATABASE']='offershowme';
    $key['DB_USERNAME']='root';
    $key['DB_PASSWORD']='';
}else{
    $key['DB_DATABASE']='opiniontitans_pepeleads';
    $key['DB_USERNAME']='opiniontitans_pepeleads';
    $key['DB_PASSWORD']='Dishant@321';
}


return $key;