<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/reports', 'DashboardController::laporan');

//login
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// Vendor
$routes->get('/vendors', 'VendorController::index');
$routes->get('/vendor/create', 'VendorController::create');
$routes->post('/vendor/store', 'VendorController::store');
$routes->get('/vendor/edit/(:num)', 'VendorController::edit/$1');
$routes->post('/vendor/update/(:num)', 'VendorController::update/$1');
$routes->get('/vendor/delete/(:num)', 'VendorController::delete/$1');

// Category
$routes->get('category', 'CategoryController::index');
$routes->get('category/create', 'CategoryController::create');
$routes->post('category/store', 'CategoryController::store');
$routes->get('category/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('category/update/(:num)', 'CategoryController::update/$1');
$routes->get('category/delete/(:num)', 'CategoryController::delete/$1');

// Product
$routes->get('/products', 'ProductController::index');
$routes->get('/product/create', 'ProductController::create');
$routes->post('/product/store', 'ProductController::store');
$routes->get('/product/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/product/update/(:num)', 'ProductController::update/$1');
$routes->get('/product/delete/(:num)', 'ProductController::delete/$1');

// PURCHASE
$routes->get('/purchases', 'PurchaseController::index');
$routes->get('/purchase/create', 'PurchaseController::create');
$routes->post('/purchase/store', 'PurchaseController::store');
$routes->get('/purchase/edit/(:num)', 'PurchaseController::edit/$1');
$routes->post('/purchase/update/(:num)', 'PurchaseController::update/$1');
$routes->get('/purchase/delete/(:num)', 'PurchaseController::delete/$1');

// PURCHASE ITEM
$routes->get('purchase-item/(:num)', 'PurchaseItemController::index/$1');
$routes->get('purchase-item/create/(:num)', 'PurchaseItemController::create/$1');
$routes->post('purchase-item/store', 'PurchaseItemController::store');
$routes->get('purchase-item/edit/(:num)', 'PurchaseItemController::edit/$1');
$routes->post('purchase-item/update/(:num)', 'PurchaseItemController::update/$1');
$routes->get('purchase-item/delete/(:num)', 'PurchaseItemController::delete/$1');

// Incoming Items
$routes->get('incoming-items', 'IncomingItemController::index');
$routes->get('incoming-items/create/(:num)', 'IncomingItemController::create/$1');
$routes->post('incoming-items/store', 'IncomingItemController::store');
$routes->get('incoming-items/delete/(:num)', 'IncomingItemController::delete/$1');


// Outgoing Items
$routes->get('/outgoing-items', 'OutgoingItemController::index');
$routes->get('/outgoing-item/create', 'OutgoingItemController::create');
$routes->post('/outgoing-item/store', 'OutgoingItemController::store');
$routes->get('/outgoing-item/delete/(:num)', 'OutgoingItemController::delete/$1');
