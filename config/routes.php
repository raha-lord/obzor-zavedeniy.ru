<?php
    return array(
        //Посты
        'post/([0-9]+)'=>'post/view/$1',
        //
        'content/([0-9]+)'=>'content/view/$1',
        'content'=>'content/index',
        //
        'category/([0-9]+)/page-([0-9]+)'=>'category/index/$1/$2',
        'category/([0-9]+)'=>'category/index/$1',
        //Организации
        'organization/([0-9]+)/([0-9]+)'=>'organization/index/$1/$2',
        'organization/create'=>'organization/create',
        'organization/change'=>'organization/change',
        'organization/([0-9]+)'=>'organization/index/$1',
        //News
        'news/([0-9]+)'=>'news/view/$1',
        //Пользователи
        'user/register'=>'user/register',
        'user/login'=>'user/login',
        'user/logout'=>'user/logout',
        //Личный кабинет user
        'cabinet/edit'=>'cabinet/edit',
        'cabinet/logout'=>'cabinet/logout',
        'cabinet'=>'cabinet/index',
        //Личный кабинет manager
        'manager/changeContentStatus/([0-9]+)'=>'manager/changeContentStatus/$1',
        'manager/deleteContent/([0-9]+)'=>'manager/deleteContent/$1',
        'manager/updateContent/([0-9]+)'=>'manager/updateContent/$1',
        'manager/createContent'=>'manager/createContent',
        'manager'=>'manager/index',
        //Управление новостями
        'admin/news/create'=>'adminNews/create',
        'admin/news/update/([0-9]+)'=>'adminNews/update/$1',
        'admin/news/delete/([0-9]+)'=>'adminNews/delete/$1',
        'admin/news'=>'adminNews/index',
        //Управление категориями
        'admin/news/category/create'=>'adminNewsCategory/create',
        'admin/news/category/delete/([0-9]+)'=>'adminNewsCategory/create/$1',
        'admin/news/category/update/([0-9]+)'=>'adminNewsCategory/update/$1',
        'admin/news/category'=>'adminNewsCategory/index',
        //Страница админа
        'admin'=>'admin/index',
        //Главная страница
        ''=>'site/index',
    );