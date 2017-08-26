<?php

$result = db_query('select * from user');

while($row = db_fetch($result)){
    echo $row['name'].'<br>';
}

db_free($result);

$result = db_query('select * from user order by name ASC');

while($row = db_fetch($result)){
    echo $row['name'].'<br>';
}
