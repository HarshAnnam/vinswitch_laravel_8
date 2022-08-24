<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Vinkla\Hashids\Facades\Hashids;
use Hashids\Hashids;

class EncreptDecrept extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    // refarance link https://github.com/vinkla/hashids
    public function encrept($id){
        // return $id;
        $hashids = new Hashids('', 10);

        return $hashids->encode($id);
       // return Hashids::encode($id);
        
    }

    public function decrept($id){
        // return $id;
        $hashids = new Hashids('', 10);

        $id_de = $hashids->decode($id);
        // dd($id_de);
        return (isset($id_de) && isset($id_de[0])) ? $id_de[0] : $id_de;
        
    }
}
