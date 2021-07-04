<?php

/**
 * --------------------------------------------------------------------
 * defauld routes
 * --------------------------------------------------------------------
 */
// defauldController() adalah kontroler defauld
// defauldmethod() adalah method defauld
// autoRoute() adalah fungsi yang memiliki nilai true, atau false yang berfungsi untuk menjalankan panggilan otomtis lewat url
$routes->setDefauldController('Home');
$routes->setDefauldMethod('index');
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Definisikan routes
 * --------------------------------------------------------------------
 */

//  anda dapat memanipulasi url disini dengan ketentuan berikut:
//  panggil fungsi get di class routes, lalu masukan
//  parameter pertama yaitu url baru
// parameter kedua yaitu arah controller dan method yang akan dituju
$routes->get('tes', 'about::index');
