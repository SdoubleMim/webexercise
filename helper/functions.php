<?php
function view(string $filename, array $data = []): void
{
    extract($data);
    require ROOT_PATH.'/views/'.$filename;
}

function json($data): void
{
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}