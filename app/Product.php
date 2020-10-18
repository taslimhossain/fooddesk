<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['product_name_dch', 'product_description_dch', 'fid', 'category_id', 'subcategory_id', 'product_number', 'sell_product_option', 'price_per_person', 'min_person', 'max_person', 'price_per_unit', 'price_weight', 'discount', 'discount_person', 'status', 'allday_availability', 'availability', 'advance_payment', 'available_after', 'duedate', 'conserve_min', 'conserve_max', 'weight', 'weight_unit', 'barcode_nbr', 'format_label', 'type', 'type_label', 'extra_notification_dch', 'ingredients_dch', 'e_val_1', 'e_val_2', 'carbo', 'sugar', 'fats', 'sat_fats', 'salt', 'fibers', 'natrium', 'allergence_dch', 'image'];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'fid');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'fid');
    }
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'product_id', 'fid');
    }
}
