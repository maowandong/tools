<?php
 
 
/**
 * @file mysql_stmt.php
 * @date 2016/09/17 22:57:09
 * @brief 
 *  
 **/


$host = '';
$username = '';
$passwd = '';
$dbname = '';
$port = 7462;


$db = new mysqli($host, $username, $passwd, $dbname, $port);

$sql = 'select id, load_time from mdm_shop_info where id > ? limit 2';

$stmt = $db->prepare($sql);

if (! $stmt) {
        echo 'mysqli prepare fail!';    
}

$id = 1;

$stmt->bind_param("i", $id);
$stmt->execute();
$resultStatus = $stmt->bind_result($result["id"],$result["load_time"]);

while ($stmt->fetch()) {
        print_r($result);
}


/*
   result


Array
(
    [id] => 136835
    [load_time] => 2016-09-17 03:00:17
)
Array
(
    [id] => 136836
    [load_time] => 2016-09-17 03:00:17
)

*/

/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
?>
