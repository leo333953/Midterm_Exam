<?php
session_start();

// If already logged in, redirect to appropriate dashboard
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    $role = $_SESSION['role'] ?? 'student';
    switch ($role) {
        case 'admin':
            header('Location: admin/dashboard');
            break;
        case 'teacher':
            header('Location: teacher/dashboard');
            break;
        case 'student':
        default:
            header('Location: announcements_direct.php');
            break;
    }
    exit;
}

$error = '';
$success = '';

if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Database connection
    $host = 'localhost';
    $dbname = 'lms_alberca';
    $username = 'root';
    $password_db = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'] ?? 'student';
            $_SESSION['isLoggedIn'] = true;
            
            // Role-based redirection
            switch ($user['role']) {
                case 'admin':
                    header('Location: admin/dashboard');
                    break;
                case 'teacher':
                    header('Location: teacher/dashboard');
                    break;
                case 'student':
                default:
                    header('Location: announcements_direct.php');
                    break;
            }
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
    } catch(PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        
                        <div class="mt-4">
                            <h6>Test Accounts:</h6>
                            <small class="text-muted">
                                Admin: admin@test.com / admin123<br>
                                Teacher: teacher@test.com / teacher123<br>
                                Student: student@test.com / student123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
