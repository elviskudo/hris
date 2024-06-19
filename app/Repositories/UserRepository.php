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

  public function create (array $data)
  {
    return User::create($data);
  }
  
  public function update ($id, array $data)
  {
    $model = User::where('id', $id);
    $model->update($data);

    return $model->first();
  }

  public function delete($id)
  {
    $model = User::find($id);

    return $model->delete();
  }
}