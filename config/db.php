<?php

return [
    'class' => 'yii\db\Connection',
    'attributes' => [
            PDO::ATTR_STRINGIFY_FETCHES => true,
    ],
    'dsn' => 'oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=202.158.123.94)(PORT=1521))(CONNECT_DATA=(SID=linux64)(SERVER=DEDICATED)))',
    'username' => 'training',
    'password' => 'training123',
    'charset' => 'utf8'
];
