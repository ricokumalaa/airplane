<?php

return [
    'class' => 'yii\db\Connection',
    'attributes' => [
            PDO::ATTR_STRINGIFY_FETCHES => true,
    ],
    'dsn' => 'oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=24)(PORT=1))(CONNECT_DATA=(SID=linux64)(SERVER=DEDICATED)))',
    'username' => '',
    'password' => '',
    'charset' => 'utf8'
];
