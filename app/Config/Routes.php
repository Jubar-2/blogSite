<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/blogEntries', 'Home::blogEntries');
$routes->get('postDetails/(:any)', 'Home::postDetails/$1)');
$routes->get('/contactUs', 'Home::contactUs');
$routes->get('login', 'Home::login', ['filter' => 'Guest']);
$routes->get('registration', 'Home::registration', ['filter' => 'Guest']);
$routes->get('/logout', 'Users::logout', ['filter' => 'Loggedin']);
$routes->post('/usersRegistration', 'Users::usersRegistration');
$routes->post('/login_logic', 'Users::login');
$routes->post('changePass', 'Users::changePassword');
$routes->post('post', 'Users::post');
$routes->post('/fogetPassword_logic', 'Users::fogetPassword');
$routes->get('forgetPassword', 'Home::forgetPassword', ['filter' => 'Guest']);
$routes->get('profile/(:any)/(:any)', 'Home::profileOption/$1/$2', ['filter' => 'Loggedin', 'filter' => 'Verify']);
$routes->get('profile/(:any)', 'Home::profile/$1', ['filter' => 'Loggedin', 'filter' => 'Verify']);
$routes->get('newPassword/(:any)', 'Home::newPassword/$1', ['filter' => 'RecoverAllowd']);
$routes->get('verify/(:any)', 'Home::verify/$1', ['filter' => 'Unverify']);
$routes->get('verifyEmail/(:any)', 'Home::verifyEmail/$1');
$routes->post('emailVerify/(:any)', 'Users::emailVerify/$1');
$routes->post('verifyEmail_logic/(:any)', 'Users::verifyEmail_logic/$1');
$routes->get('codeResent/(:any)', 'Users::codeResent/$1', ['filter' => 'Unverify']);
$routes->post('newPassword_logic/(:any)', 'Users::newPasswod/$1');
$routes->post('comment/(:any)', 'Users::comment/$1');
$routes->post('profilePic/(:any)', 'Users::profilePic/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
