<?php

$key=[
    'DB_CONNECTION'=>'mysql',
    'DB_HOST'=>'127.0.0.1',
    'DB_PORT'=>'3306',
  
    'MAIL_MAILER'=>'smtp',
    'MAIL_HOST'=>'smtp.gmail.com',
    'MAIL_PORT'=>'587',
    'MAIL_USERNAME'=>'business@moustacheleads.com',
    'MAIL_PASSWORD'=>env('MAIL_PASSWORD'),
    'MAIL_ENCRYPTION'=>'tls',
    'MAIL_FROM_ADDRESS'=>'business@moustacheleads.com',
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