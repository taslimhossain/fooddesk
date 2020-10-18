<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

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
    protected $fillable = ['banner5','banner2','banner3','banner4','from_exception','to_exception','site_name', 'logo', 'api_key', 'from_email', 'fav_icon',
     '	them_color', 'company_id', 'sidebar', 'view', 'pagination_length',
      'banner', 'sticky_logo', 'default_product', 'phone', 'address', 'homepage_notice',
       'show_notice', 'ok_mail_subject', 'success_mail_subject', 'hold_mail_subject',
        'collection_complete_subject', 'delivery_complete_subject', 'ok_mail',
        'success_mail', 'hold_mail', 'collection_complete', 'delivery_complete', 'offline',
         'offline_message', 'hide_rate', 'hide_rate_guest', 'css','host','port','from_name','encryption','username','password',
        'follow_us','contact_address','contact_phone','contact_email','privacy','terms','payments','copyright','hide_news','follow_us','cron_hour','cron_minute','signup_message','signup_title',
        'order_email','order_place_title','order_place_body','order_admin_title','order_admin_body','home_delivery_subject','home_delivery_body',"wishList","ingredient"

    ];
}
