<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password'];
    //TODO: add other important attributes to the user (id_number, phone, last_name, birth, ...)

    public function getUsers($id = null)
    {
        if ($id === null){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}