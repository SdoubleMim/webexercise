<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    
    public function composite(): string
    {
        return "{$this->name} ({$this->email})";
    }
    
    public static function find(int $id): ?self
    {
        return static::query()->find($id);
    }
}