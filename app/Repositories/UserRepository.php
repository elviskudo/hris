<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
  public function list ()
  {
    return User::all();
  }

  public function detail ($id)
  {
    return User::find($id);
  }

  public function insert ($data)
  {
    
  }
}