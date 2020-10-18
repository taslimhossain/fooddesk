<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fid', 'name', 'image', 'description','status'];
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'fid')->orderBy('name');
    }
    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id', 'fid');
    }
}
