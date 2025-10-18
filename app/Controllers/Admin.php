<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;

class Admin extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        // Check if user has admin role
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('announcements'))->with('error', 'Access Denied: Insufficient Permissions');
        }

        // Fetch latest announcements
        $announcements = $this->announcementModel->orderBy('created_at', 'DESC')->limit(3)->findAll();

        $data = [
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role'),
            'announcements' => $announcements
        ];

        return view('admin_dashboard', $data);
    }
}
