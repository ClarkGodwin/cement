<?php

if(isset($_GET['page'])){
        switch($_GET['page']){
                case 'home':
                        header('location: Controllers/Pages/Home/home.php'); 
                        break;
                
                case 'admin':
                        header('location: Controllers/Pages/Admin/admin.php'); 
                        break; 
                
                default:
                        header('location: Controllers/Pages/Home/home.php'); 
                        break;
                
        }
}
else{
        header('location: Controllers/Pages/Home/home.php'); 
}
