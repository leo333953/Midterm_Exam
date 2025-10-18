<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the New Academic Year!',
                'content' => 'We are excited to welcome all students to the new academic year. Please make sure to check your course schedules and attend all orientation sessions. If you have any questions, feel free to contact the administration office.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'title' => 'Important: Midterm Examination Schedule',
                'content' => 'The midterm examination schedule has been posted. Please check your student portal for your specific exam dates and times. Remember to bring your student ID and arrive 15 minutes early. Good luck to all students!',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'title' => 'Library Hours Update',
                'content' => 'The university library will now be open 24/7 during the examination period to provide students with extended study hours. Please respect the quiet study environment and follow all library policies.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours'))
            ]
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
