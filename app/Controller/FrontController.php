<?php

namespace App\Controller;

use App\Model\User;

class FrontController
{
    public function home()
    {
        $id = $this->sanitizeId($_GET['id'] ?? 0);
        $user = User::find($id);
        
        if ($user) {
            return $this->jsonResponse($user->composite());
        }
        
        return $this->response('User does not exist', 404);
    }

    public function about()
    {
        return $this->view('about.php');
    }

    public function infs()
    {
        return $this->view('infs.php');
    }

    protected function view($template, $data = [])
    {
        // Assuming you have a view helper
        if (function_exists('view')) {
            return view($template, $data);
        }
        
        // Fallback if view helper doesn't exist
        foreach ($data as $key => $value) {
        ${$key} = htmlspecialchars($value, ENT_QUOTES);
    }
        include __DIR__ . '/../../views/' . $template;
    }

    protected function jsonResponse($data)
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }

    protected function response($message, $status = 200)
    {
        http_response_code($status);
        return $message;
    }

    protected function sanitizeId($id)
    {
        return filter_var($id, FILTER_VALIDATE_INT, ['options' => [
            'min_range' => 1,
            'default' => 0
        ]]);
    }
}