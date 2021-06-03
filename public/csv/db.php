<?php
include __DIR__.'/idiorm.php';
$config =[
    'host'=>'localhost',
    'username' => 'bombimdb',
    'password' => '8YjWzrd239x2VtTvuz3R',
    'database'=>'bomh',
    'charset'=>'utf8'
];
$mysql = 'mysql:host='.$config['host'].';';
$mysql.='dbname='.$config['database'].';';
$mysql.='charset='.$config['charset'].';';
$name = "casino";
\ORM::configure(array(
    'connection_string'=>$mysql,
    'username'=>$config['username'],
    'password'=>$config['password'],
    "logging"=>true
),null);