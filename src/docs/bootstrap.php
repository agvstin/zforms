<?php
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
$dir = realpath(__DIR__ .'/../php/lib');
if (is_dir($dir)) {
    ini_set('include_path', ini_get('include_path')
        .PATH_SEPARATOR .$dir
    );
}


// create view
$view = new Zend_View(array(
    'scriptPath' => __DIR__
));

// create form
$form = new zforms\Form(array(
    'description' => 'Example Form'
));
$form->setView($view);

// add css and js to view
$cssDir = realpath(__DIR__ .'/../data');
if (is_dir($dir)) {
    $view->css = file_get_contents($cssDir .'/tipsy.css')
        .PHP_EOL
        . file_get_contents($cssDir .'/zforms.css');


    $view->js = file_get_contents($cssDir .'/jquery.tipsy.js')
        .PHP_EOL
        . file_get_contents($cssDir .'/jquery.zforms.js')
        .PHP_EOL
        . '$(function() {$(".zforms-wrapper").zforms()});'
        ;
}

$view->form = $form;
