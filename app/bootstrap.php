<?php 
session_start();

include ROOT . '/app/etc/config.php'; 
include ROOT . '/app/core/DbSingleton.php';  
include ROOT . '/app/core/DB.php';  
include ROOT . '/app/core/model.php'; 
function myAutoloader($class_name) {   
    include ROOT . '/app/models/' . ucfirst($class_name) . '.php'; 
}
spl_autoload_register("myAutoloader");
include ROOT . '/app/core/Helper.php';  
include ROOT . '/app/core/controller.php'; 
include ROOT . '/app/core/route.php';  
Route::Start(); 