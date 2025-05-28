<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-5">
    <h2>Create User</h2>
    <form method="POST" action="/users/create">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>