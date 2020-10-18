<div class="form-group {{ $errors->has('product_name_dch') ? 'has-error' : ''}}">
    <label for="product_name_dch" class="control-label">{{ 'Product Name Dch' }}</label>
    <input class="form-control" name="product_name_dch" type="text" id="product_name_dch" value="{{ isset($product->product_name_dch) ? $product->product_name_dch : ''}}" >
    {!! $errors->first('product_name_dch', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_description_dch') ? 'has-error' : ''}}">
    <label for="product_description_dch" class="control-label">{{ 'Product Description Dch' }}</label>
    <textarea class="form-control" rows="5" name="product_description_dch" type="textarea" id="product_description_dch" >{{ isset($product->product_description_dch) ? $product->product_description_dch : ''}}</textarea>
    {!! $errors->first('product_description_dch', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fid') ? 'has-error' : ''}}">
    <label for="fid" class="control-label">{{ 'Fid' }}</label>
    <input class="form-control" name="fid" type="number" id="fid" value="{{ isset($product->fid) ? $product->fid : ''}}" >
    {!! $errors->first('fid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="control-label">{{ 'Category Id' }}</label>
    <input class="form-control" name="category_id" type="text" id="category_id" value="{{ isset($product->category_id) ? $product->category_id : ''}}" >
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : ''}}">
    <label for="subcategory_id" class="control-label">{{ 'Subcategory Id' }}</label>
    <input class="form-control" name="subcategory_id" type="text" id="subcategory_id" value="{{ isset($product->subcategory_id) ? $product->subcategory_id : ''}}" >
    {!! $errors->first('subcategory_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_number') ? 'has-error' : ''}}">
    <label for="product_number" class="control-label">{{ 'Product Number' }}</label>
    <input class="form-control" name="product_number" type="text" id="product_number" value="{{ isset($product->product_number) ? $product->product_number : ''}}" >
    {!! $errors->first('product_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sell_product_option') ? 'has-error' : ''}}">
    <label for="sell_product_option" class="control-label">{{ 'Sell Product Option' }}</label>
    <input class="form-control" name="sell_product_option" type="text" id="sell_product_option" value="{{ isset($product->sell_product_option) ? $product->sell_product_option : ''}}" >
    {!! $errors->first('sell_product_option', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price_per_person') ? 'has-error' : ''}}">
    <label for="price_per_person" class="control-label">{{ 'Price Per Person' }}</label>
    <input class="form-control" name="price_per_person" type="text" id="price_per_person" value="{{ isset($product->price_per_person) ? $product->price_per_person : ''}}" >
    {!! $errors->first('price_per_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('min_person') ? 'has-error' : ''}}">
    <label for="min_person" class="control-label">{{ 'Min Person' }}</label>
    <input class="form-control" name="min_person" type="text" id="min_person" value="{{ isset($product->min_person) ? $product->min_person : ''}}" >
    {!! $errors->first('min_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('max_person') ? 'has-error' : ''}}">
    <label for="max_person" class="control-label">{{ 'Max Person' }}</label>
    <input class="form-control" name="max_person" type="text" id="max_person" value="{{ isset($product->max_person) ? $product->max_person : ''}}" >
    {!! $errors->first('max_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price_per_unit') ? 'has-error' : ''}}">
    <label for="price_per_unit" class="control-label">{{ 'Price Per Unit' }}</label>
    <input class="form-control" name="price_per_unit" type="text" id="price_per_unit" value="{{ isset($product->price_per_unit) ? $product->price_per_unit : ''}}" >
    {!! $errors->first('price_per_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price_weight') ? 'has-error' : ''}}">
    <label for="price_weight" class="control-label">{{ 'Price Weight' }}</label>
    <input class="form-control" name="price_weight" type="text" id="price_weight" value="{{ isset($product->price_weight) ? $product->price_weight : ''}}" >
    {!! $errors->first('price_weight', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'Discount' }}</label>
    <input class="form-control" name="discount" type="text" id="discount" value="{{ isset($product->discount) ? $product->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount_person') ? 'has-error' : ''}}">
    <label for="discount_person" class="control-label">{{ 'Discount Person' }}</label>
    <input class="form-control" name="discount_person" type="text" id="discount_person" value="{{ isset($product->discount_person) ? $product->discount_person : ''}}" >
    {!! $errors->first('discount_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($product->status) ? $product->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('allday_availability') ? 'has-error' : ''}}">
    <label for="allday_availability" class="control-label">{{ 'Allday Availability' }}</label>
    <input class="form-control" name="allday_availability" type="text" id="allday_availability" value="{{ isset($product->allday_availability) ? $product->allday_availability : ''}}" >
    {!! $errors->first('allday_availability', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('availability') ? 'has-error' : ''}}">
    <label for="availability" class="control-label">{{ 'Availability' }}</label>
    <input class="form-control" name="availability" type="text" id="availability" value="{{ isset($product->availability) ? $product->availability : ''}}" >
    {!! $errors->first('availability', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('advance_payment') ? 'has-error' : ''}}">
    <label for="advance_payment" class="control-label">{{ 'Advance Payment' }}</label>
    <input class="form-control" name="advance_payment" type="text" id="advance_payment" value="{{ isset($product->advance_payment) ? $product->advance_payment : ''}}" >
    {!! $errors->first('advance_payment', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('available_after') ? 'has-error' : ''}}">
    <label for="available_after" class="control-label">{{ 'Available After' }}</label>
    <input class="form-control" name="available_after" type="text" id="available_after" value="{{ isset($product->available_after) ? $product->available_after : ''}}" >
    {!! $errors->first('available_after', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('duedate') ? 'has-error' : ''}}">
    <label for="duedate" class="control-label">{{ 'Duedate' }}</label>
    <input class="form-control" name="duedate" type="text" id="duedate" value="{{ isset($product->duedate) ? $product->duedate : ''}}" >
    {!! $errors->first('duedate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conserve_min') ? 'has-error' : ''}}">
    <label for="conserve_min" class="control-label">{{ 'Conserve Min' }}</label>
    <input class="form-control" name="conserve_min" type="text" id="conserve_min" value="{{ isset($product->conserve_min) ? $product->conserve_min : ''}}" >
    {!! $errors->first('conserve_min', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conserve_max') ? 'has-error' : ''}}">
    <label for="conserve_max" class="control-label">{{ 'Conserve Max' }}</label>
    <input class="form-control" name="conserve_max" type="text" id="conserve_max" value="{{ isset($product->conserve_max) ? $product->conserve_max : ''}}" >
    {!! $errors->first('conserve_max', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('weight') ? 'has-error' : ''}}">
    <label for="weight" class="control-label">{{ 'Weight' }}</label>
    <input class="form-control" name="weight" type="text" id="weight" value="{{ isset($product->weight) ? $product->weight : ''}}" >
    {!! $errors->first('weight', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('weight_unit') ? 'has-error' : ''}}">
    <label for="weight_unit" class="control-label">{{ 'Weight Unit' }}</label>
    <input class="form-control" name="weight_unit" type="text" id="weight_unit" value="{{ isset($product->weight_unit) ? $product->weight_unit : ''}}" >
    {!! $errors->first('weight_unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('barcode_nbr') ? 'has-error' : ''}}">
    <label for="barcode_nbr" class="control-label">{{ 'Barcode Nbr' }}</label>
    <input class="form-control" name="barcode_nbr" type="text" id="barcode_nbr" value="{{ isset($product->barcode_nbr) ? $product->barcode_nbr : ''}}" >
    {!! $errors->first('barcode_nbr', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('format_label') ? 'has-error' : ''}}">
    <label for="format_label" class="control-label">{{ 'Format Label' }}</label>
    <input class="form-control" name="format_label" type="text" id="format_label" value="{{ isset($product->format_label) ? $product->format_label : ''}}" >
    {!! $errors->first('format_label', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{ isset($product->type) ? $product->type : ''}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_label') ? 'has-error' : ''}}">
    <label for="type_label" class="control-label">{{ 'Type Label' }}</label>
    <input class="form-control" name="type_label" type="text" id="type_label" value="{{ isset($product->type_label) ? $product->type_label : ''}}" >
    {!! $errors->first('type_label', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('extra_notification_dch') ? 'has-error' : ''}}">
    <label for="extra_notification_dch" class="control-label">{{ 'Extra Notification Dch' }}</label>
    <textarea class="form-control" rows="5" name="extra_notification_dch" type="textarea" id="extra_notification_dch" >{{ isset($product->extra_notification_dch) ? $product->extra_notification_dch : ''}}</textarea>
    {!! $errors->first('extra_notification_dch', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ingredients_dch') ? 'has-error' : ''}}">
    <label for="ingredients_dch" class="control-label">{{ 'Ingredients Dch' }}</label>
    <textarea class="form-control" rows="5" name="ingredients_dch" type="textarea" id="ingredients_dch" >{{ isset($product->ingredients_dch) ? $product->ingredients_dch : ''}}</textarea>
    {!! $errors->first('ingredients_dch', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('e_val_1') ? 'has-error' : ''}}">
    <label for="e_val_1" class="control-label">{{ 'E Val 1' }}</label>
    <input class="form-control" name="e_val_1" type="text" id="e_val_1" value="{{ isset($product->e_val_1) ? $product->e_val_1 : ''}}" >
    {!! $errors->first('e_val_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('e_val_2') ? 'has-error' : ''}}">
    <label for="e_val_2" class="control-label">{{ 'E Val 2' }}</label>
    <input class="form-control" name="e_val_2" type="text" id="e_val_2" value="{{ isset($product->e_val_2) ? $product->e_val_2 : ''}}" >
    {!! $errors->first('e_val_2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('carbo') ? 'has-error' : ''}}">
    <label for="carbo" class="control-label">{{ 'Carbo' }}</label>
    <input class="form-control" name="carbo" type="text" id="carbo" value="{{ isset($product->carbo) ? $product->carbo : ''}}" >
    {!! $errors->first('carbo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sugar') ? 'has-error' : ''}}">
    <label for="sugar" class="control-label">{{ 'Sugar' }}</label>
    <input class="form-control" name="sugar" type="text" id="sugar" value="{{ isset($product->sugar) ? $product->sugar : ''}}" >
    {!! $errors->first('sugar', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fats') ? 'has-error' : ''}}">
    <label for="fats" class="control-label">{{ 'Fats' }}</label>
    <input class="form-control" name="fats" type="text" id="fats" value="{{ isset($product->fats) ? $product->fats : ''}}" >
    {!! $errors->first('fats', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sat_fats') ? 'has-error' : ''}}">
    <label for="sat_fats" class="control-label">{{ 'Sat Fats' }}</label>
    <input class="form-control" name="sat_fats" type="text" id="sat_fats" value="{{ isset($product->sat_fats) ? $product->sat_fats : ''}}" >
    {!! $errors->first('sat_fats', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('salt') ? 'has-error' : ''}}">
    <label for="salt" class="control-label">{{ 'Salt' }}</label>
    <input class="form-control" name="salt" type="text" id="salt" value="{{ isset($product->salt) ? $product->salt : ''}}" >
    {!! $errors->first('salt', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fibers') ? 'has-error' : ''}}">
    <label for="fibers" class="control-label">{{ 'Fibers' }}</label>
    <input class="form-control" name="fibers" type="text" id="fibers" value="{{ isset($product->fibers) ? $product->fibers : ''}}" >
    {!! $errors->first('fibers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('natrium') ? 'has-error' : ''}}">
    <label for="natrium" class="control-label">{{ 'Natrium' }}</label>
    <input class="form-control" name="natrium" type="text" id="natrium" value="{{ isset($product->natrium) ? $product->natrium : ''}}" >
    {!! $errors->first('natrium', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('allergence_dch') ? 'has-error' : ''}}">
    <label for="allergence_dch" class="control-label">{{ 'Allergence Dch' }}</label>
    <input class="form-control" name="allergence_dch" type="text" id="allergence_dch" value="{{ isset($product->allergence_dch) ? $product->allergence_dch : ''}}" >
    {!! $errors->first('allergence_dch', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
