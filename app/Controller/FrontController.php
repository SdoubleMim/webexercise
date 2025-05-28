<?php
namespace App\Controller;

use App\Model\User;

class FrontController
{
    // Add these base methods first
    protected function sanitizeId($id): int
    {
        return filter_var($id, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1]
        ]) ?: 0;
    }

    protected function jsonResponse(array $data, int $status = 200): string
    {
        http_response_code($status);
        header('Content-Type: application/json');
        return json_encode($data);
    }

    protected function response(string $message, int $status = 200): string
    {
        http_response_code($status);
        return $message;
    }

    protected function view(string $template, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../../views/' . $template;
    }

    // CRUD Methods
    public function deleteUser($id)
    {
        $id = $this->sanitizeId($id);
        if (User::deleteUser($id)) {
            return $this->jsonResponse(['success' => true]);
        }
        return $this->response('Deletion failed', 400);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::createUser([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);
            
            return $user 
                ? $this->jsonResponse(['success' => true, 'user' => $user])
                : $this->response('Creation failed', 400);
        }
        
        return $this->view('users/create.php');
    }

    public function editUser($id)
    {
        $id = $this->sanitizeId($id);
        $user = User::find($id);

        if (!$user) {
            return $this->response('User not found', 404);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            return $user->updateUser($data)
                ? $this->jsonResponse(['success' => true])
                : $this->response('Update failed', 400);
        }
        
        return $this->view('users/edit.php', ['user' => $user]);
    }
}