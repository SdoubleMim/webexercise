<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-5">
    <h2>Edit User</h2>
    <?php if (isset($user) && is_object($user)): ?>
        <form method="POST" action="<?= htmlspecialchars("/users/{$user->id}/edit", ENT_QUOTES) ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" 
                       value="<?= htmlspecialchars($user->name ?? '', ENT_QUOTES) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($user->email ?? '', ENT_QUOTES) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">User data not available</div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>