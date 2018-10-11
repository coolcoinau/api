<?php
error_reporting(E_ALL);
//引入api类
include "coolcoinApi.php";

//实例化对象
$obj = new coolcoinApi();
$balance = $obj->openorder();

//打印输出
var_dump($balance);
