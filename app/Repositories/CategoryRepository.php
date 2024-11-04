<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
  public function getAll()
  {
    return Category::all();
  }

  public function find($id)
  {
    return Category::findOrFail($id);
  }

  public function create(array $data)
  {
    return Category::create($data);
  }

  public function update($id, array $data)
  {
    $category = $this->find($id);
    $category->update($data);
    return $category;
  }
}