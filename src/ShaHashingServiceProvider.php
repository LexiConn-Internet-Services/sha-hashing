<?php

namespace LexiConnInternetServices\ShaHashing;

use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;
use LexiConnInternetServices\ShaHashing\Hashers\Sha256Hasher;
use LexiConnInternetServices\ShaHashing\Hashers\Sha512Hasher;

class ShaHashingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /** @var HashManager $hash */
        $hash = $this->app['hash'];
        $hash->extend('sha256', function(){
            return new Sha256Hasher();
        });
        $hash->extend('sha512', function(){
            return new Sha512Hasher();
        });
    }
}
