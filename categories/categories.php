<?php 

function saveCategoryForm($params)
{
    $userData = [
        'name' => $params['name'],
    ];
    $tmp = file_get_contents('category.json');
    if (strlen($tmp) === 0) {
        $data = [$userData];
    } else {
        $data = json_decode($tmp);
        $data[] = $userData;
    }
    return file_put_contents('category.json', json_encode($data));
}

function getCategory()
{
    $categories = file_get_contents('category.json');
    return json_decode($categories);
}
function deleteCategory($params)
{
    $categories = [];
    foreach (getCategory() as $category) {
        if ($category->name === trim($params['name'])) {
           unset($category);
                
       } else {
            $categories[] = $category;
        }
    }
    return file_put_contents('category.json', json_encode($categories));

}