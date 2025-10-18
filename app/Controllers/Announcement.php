<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    /**
     * Display all announcements
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        // Fetch all announcements ordered by created_at descending (newest first)
        $announcements = $this->announcementModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'announcements' => $announcements,
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role')
        ];

        return view('announcements', $data);
    }
}