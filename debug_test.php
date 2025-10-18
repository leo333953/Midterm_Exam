<?php
// Simple debug test
echo "<h1>Debug Test</h1>";
echo "<p>PHP is working! Time: " . date('Y-m-d H:i:s') . "</p>";

// Test if we can access the CodeIgniter framework
try {
    // Set the environment
    $_SERVER['CI_ENVIRONMENT'] = 'development';
    
    // Load CodeIgniter
    require_once 'index.php';
    
    echo "<p>CodeIgniter loaded successfully!</p>";
    
    // Test database connection
    $db = \Config\Database::connect();
    echo "<p>Database connected successfully!</p>";
    
    // Test announcements table
    $query = $db->query("SELECT COUNT(*) as count FROM announcements");
    $result = $query->getRow();
    echo "<p>Announcements in database: " . $result->count . "</p>";
    
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
