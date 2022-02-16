<?php

include('../database/connect.php');
$db = new database();

$db->link->query("DELETE FROM `product_info` WHERE `pdt_id`='".$_POST["id"]."' ");
echo "Ok";
?>