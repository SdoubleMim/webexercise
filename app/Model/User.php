<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password']; // Fields that can be mass-assigned

    public static function createUser(array $data): ?self
    {
        try {
            return static::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
        } catch (\Exception $e) {
            error_log('User creation failed: ' . $e->getMessage());
            return null;
        }
    }

    public function updateUser(array $data): bool
    {
        try {
            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            return $this->update($data);
        } catch (\Exception $e) {
            error_log('User update failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function deleteUser(int $id): bool
    {
        try {
            return (bool) static::destroy($id);
        } catch (\Exception $e) {
            error_log('User deletion failed: ' . $e->getMessage());
            return false;
        }
    }
}