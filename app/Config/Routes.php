<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/auth/logout', 'Auth::logout'); 
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/announcements', 'Announcement::index');
$routes->get('announcements', 'Announcement::index');
$routes->get('announcements/', 'Announcement::index');
$routes->get('test-simple', function() {
    return "SIMPLE TEST WORKING! Time: " . date('Y-m-d H:i:s');
});

// Role-based dashboard routes with authorization filter
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});

// For enrolling via AJAX
$routes->post('course/enroll', 'Course::enroll');

// For displaying enrolled courses / success message
$routes->get('course/enroll', 'Course::enrollPage');