<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        $userRole = session()->get('role');
        $uri = $request->getUri();
        $path = $uri->getPath();

        // Admin can access any route starting with /admin
        if ($userRole === 'admin') {
            if (strpos($path, '/admin') === 0) {
                return; // Allow access
            }
        }
        // Teacher can only access routes starting with /teacher
        elseif ($userRole === 'teacher') {
            if (strpos($path, '/teacher') === 0) {
                return; // Allow access
            }
        }
        // Student can access /student routes and /announcements
        elseif ($userRole === 'student') {
            if (strpos($path, '/student') === 0 || $path === '/announcements') {
                return; // Allow access
            }
        }

        // If user tries to access unauthorized route, redirect with error
        return redirect()->to(base_url('announcements'))->with('error', 'Access Denied: Insufficient Permissions');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after request
    }
}