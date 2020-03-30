<?php
        function resolveRoute($config){
            global $message;

            $route = 'userList';
            if(isset($_GET['route']) && strlen($_GET['route']) > 0) {
                $route = $_GET['route'];
            }

            switch ($route) {
                case 'loginForm':
                    if (isset($_GET['message'])) {
                        $message = $_GET['message'];
                    }
                    include('users/loginForm.phtml');
                    break;

                case 'login':
                    if (validateLoginForm($_POST) and login($_POST['email'], $_POST['password'])) {
                        redirect($config['baseUrl'], '&message=loggedIn');
                       
                        exit();
                    }
                    redirect($config['baseUrl'], 'loginForm&message=invalidParams');
                   
       
                    break;

                case 'registerForm':
                    include('users/userForm.phtml');
                    break;

                case 'register':

                    break;
                case 'userList':
                    if (isset($_GET['message']) && $_GET['message'] === 'loggedIn') {
                        $message = 'Uspesno ste se ulogovali';
                    }
                    $users = [];
                    $emailFilter = null;
                    if (isset($_GET['emailFilter'])) {
                        array_push($users, getUserByEmail($_GET['emailFilter']));
                    } else {
                        $users = getUsers();
                    }
                    include 'users/userList.phtml';
                    break;
                case 'userCreate':
                    $valid = validateUserForm($_POST);

                    if (!$valid) {
//                        global $message;
                        echo $valid;
                    } else {
                        if (!saveUser($_POST)) {
                            echo 'Doslo je do greske prilikom snimanja korisnika';
                        } else {
                            echo "Korisnik je uspesno sacuvan";
                        }
                    }
                    break;
                case 'userCreateForm':
                    include('users/userForm.phtml');
                    break;
                case 'userUpdate':


                    break;
                case 'userUpdateForm':
                    $user = getUserByEmail($_GET['email']);
                    include('users/userForm.phtml');

                    break;
                case 'userLogout' :
                    logOut();
                    redirect($config['baseUrl']);

                    break;
                case 'userDelete' :
                        $articles = array();
                        
                        if (!deleteUser($_GET)) {
                            $message = 'Doslo je do greske prilikom brisanja usera';
                        } else {
                            echo "User uspesno izbrisan";
    
                        }
                            break;
                //case 'articleList':
                         //$articles = getArticles(); 
                         //$article = getArticleById($id);
                        //include 'articleList.phtml';
                        //break;
                case 'articleCreateForm' :
                    $categories= getCategory();
                    include('artilces/articleForm.phtml');

                    break;
                case 'articleCreate' :
                    if (!saveArticleForm($_POST)) {
                        $message = 'Doslo je do greske prilikom snimanja clanka';
                    } else {
                        echo "Clanak uspesno sacuvan";

                    }
                    break;

                case 'articleUpdateForm' :
                    $categories= array();
                    $categories= getCategory();
                    $article = getArticleByTitle($_GET['title']);
                    include 'articles/updateArticleForm.phtml';
                    break;
                case 'articleUpdate' :
                    if (!updateArticle($_POST)) {
                        $message = 'Doslo je do greske prilikom izmene clanka';
                    } else {
                        echo "Clanak uspesno izmenjen";

                    }
                    break;
                case 'articleList' :
                    $articles = array();
                    $articleFilter = null;
                    if (isset($_GET['articleFilter'])) {
                        array_push($articles, getArticleByTitle($_GET['articleFilter']));
                    } else {
                        $articles = getArticles();
                       // $article = getArticleById($id);
                    }
                    include 'articles/articleList.phtml';
                    break;
                case 'articleDelete' :
                    $articles = array();
                    
                    if (!deleteArticle($_GET)) {
                        $message = 'Doslo je do greske prilikom brisanja clanka';
                    } else {
                        echo "Clanak uspesno izbrisan";

                    }
                        break;
                case 'categoryCreateForm' :
                    $categories = array();
                    $categories = getCategory();
                    include 'categories/categoryCreate.phtml';
                    break;
                case 'categorySave' :
                    if (!saveCategoryForm($_POST)) {
                        $message = 'Doslo je do greske prilikom snimanja';
                    } else {
                        echo "Kategorija je uspesno snimljena u bazu";
                        $categories = array();
                        $categories = getCategory();
                        include 'categories/categoryCreate.phtml';
                    }
                    break;
                case 'categoryDelete' :
                        $articles = array();
                        
                        if (!deleteCategory($_GET)) {
                            $message = 'Doslo je do greske prilikom brisanja kategorije';
                        } else {
                            echo "Kategorija uspesno izbrisana";
    
                        }
                            break;
                default:
                    echo "Dobrodosli na nash blog";
                    break;
            }
     }
 ?>
