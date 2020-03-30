<?php

function validateArticleForm()
{
    if (isset($_POST['body']) && strlen($_POST['body']) < 1 || isset($_POST['category']) && strlen($_POST['category']) < 1 ) {
        return false;
    }
    return true;

}

function saveArticleForm($params)
{
    //$fileName = saveImage();
    $articleData = [
        'title' => $params['title'],
        'description' => $params['description'],
        'body' => $params['body'],
        'category' => $params['category'],
       // 'user' => $params['user'],
        'image' => saveImage(),
    ];
    $tmp = file_get_contents('article.json');
    if (strlen($tmp) === 0) {
        $data = [$articleData];
    } else {
        $data = json_decode($tmp);
        $data[] = $articleData;
    }
    return file_put_contents('article.json', json_encode($data));
}



function getArticleByTitle($title)
{
    foreach (getArticles() as $article) {
        if ($title === $article->title) {
            return $article;
        }
    }

    return false;
}


function getArticles()
{
    $articles = file_get_contents('article.json');
    return json_decode($articles);
}

function saveArticle($params)
{
//    $articleData = [
//        'title' => $params['title']
//    ];

    $articles = [];
    foreach (getArticles() as $article) {
        if ($article->title === trim($params['title'])) {
            $articles[] = $params;
        } else {
            $articles[] = $article;
        }

    }
    return file_put_contents('article.json', json_encode($articles));
}

function updateArticle($params)
{
    $articles = [];
    foreach (getArticles() as $article) {
        if ($article->title === trim($params['title'])) {
            $articles[] = [
                'title' => $params['title'],
                'description' => $params['description'],
                'body' => $params['body'],
                'category' => $params['category'],
                'image' => saveImage(),
            ];
       } else {
            $articles[] = $article;
        }
    }
    return file_put_contents('article.json', json_encode($articles));
}

function deleteArticle($params)
{
    $articles = [];
    foreach (getArticles() as $article) {
        if ($article->title === trim($params['title'])) {
           unset($article);
                
       } else {
            $articles[] = $article;
        }
    }
    return file_put_contents('article.json', json_encode($articles));

}