<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Student Portal</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Welcome, <?= $user_name ?> (<?= ucfirst($user_role) ?>)</span>
                <a class="nav-link" href="<?= base_url('announcements') ?>">Announcements</a>
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Welcome, Teacher!</h2>
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Announcements Section -->
                <div class="card shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Latest Announcements</h5>
                        <a href="<?= base_url('announcements') ?>" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>
                    
                    
                    <?php if (empty($announcements)): ?>
                        <p class="text-muted">No announcements available.</p>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($announcements as $announcement): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title text-primary"><?= esc($announcement['title']) ?></h6>
                                            <p class="card-text small text-muted"><?= esc(substr($announcement['content'], 0, 100)) ?>...</p>
                                            <small class="text-muted"><?= date('M j, Y', strtotime($announcement['created_at'])) ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Teacher Dashboard</h5>
                        <p class="card-text">This is the teacher dashboard. Here you can manage your courses, view student progress, and access teaching resources.</p>
                        <p class="card-text">More features will be added in future updates.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('announcements') ?>" class="btn btn-primary">View Announcements</a>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">General Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
