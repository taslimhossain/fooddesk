<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('settings')) {
            $mail = DB::table('settings')->first();
            if ($mail) //checking if table is not empty
            {
                $config = array(
                    'driver'     => "smtp",
                    'host'       => $mail->host,
                    'port'       => $mail->port,
                    'from'       => array('address' => $mail->from_email, 'name' => $mail->from_name),
                    'encryption' => $mail->encryption,
                    'username'   => $mail->username,
                    'password'   => $mail->password,
                    // 'sendmail'   => '/usr/sbin/sendmail -bs',
                    // 'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}