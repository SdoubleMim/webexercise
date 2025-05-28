<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-5">
    <div class="card border-info">
        <div class="card-header bg-info text-white">
            <h2 class="text-center">اطلاعات سیستم</h2>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <h4>مشخصات فنی</h4>
                <ul>
                    <li>PHP <?= phpversion() ?></li>
                    <li>سرور: <?= $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' ?></li>
                    <li>پایگاه داده: MySQL</li>
                </ul>
            </div>
            
            <div class="alert alert-secondary mt-4">
                <h4>راهنمای سیستم</h4>
                <p>
                    برای استفاده از سیستم باید ابتدا در سایت ثبت‌نام نمایید.
                </p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>