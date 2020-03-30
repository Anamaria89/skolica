<?php
//echo md5('12345678');
//die();
     $message = '';
    

     include('route.php');
     include('functions.php');
     include('users/users.php');
     include('articles/articles.php');
     include('categories/categories.php');
    
     $config = include('config.php');
     bootstrap();
     include ('header.phtml') ;

     try {
          resolveRoute($config);
     } catch (\Exception $e) {

     }



     // try {
     //      if (validateParams($_POST)) {
     //           registerUser($_POST);
     //           echo "OK";
     //      }
     //      else {
     //           include('loginForm.phtml');
     //      }
     //
     // } catch (Exception $e) {
     //      echo $e -> getMessage();
     //      die();
     // }


 ?>
