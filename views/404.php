<?php 
http_response_code(404);
require __DIR__ . '/header.php'; 
?>

<div class="container mt-5">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h1 class="text-center">۴۰۴ - صفحه یافت نشد</h1>
        </div>
        <div class="card-body text-center">
            <img src="https://via.placeholder.com/300x200?text=404+Error" alt="404 Error" class="img-fluid mb-4">
            <p class="lead">صفحه مورد نظر شما وجود ندارد یا حذف شده است.</p>
            <a href="/" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>