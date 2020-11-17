<?php

namespace LexiConnInternetServices\ShaHashing\Hashers;

use Illuminate\Hashing\AbstractHasher;
use RuntimeException;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Support\Str;

/**
 * Class CryptHasher
 */
class ShaHasher extends AbstractHasher implements HasherContract
{
    const FAILED_HASH = '*0';
    
    protected $prefix = '6';
    protected $saltLength = 16;
    protected $rounds = 0;
    
    
    public function make($value, array $options = [])
    {
        $salt = $options['salt'] ?? Str::random(16);
        $rounds = $options['rounds'] ?? $this->rounds;
        
        $salt = ($rounds > 0) ? '$'.$this->prefix.'$rounds='.$rounds.'$'.$salt.'$' : '$'.$this->prefix.'$'.$salt.'$';
        $hash = crypt($value, $salt);
        
        if($hash === self::FAILED_HASH)
        {
            throw new RuntimeException('Hashing Failed');
        }
        
        return $hash;
    }
    
    public function needsRehash($hashedValue, array $options = [])
    {
        if(!isset($options['salt']) && !isset($options['rounds'])){
            return false;
        }
        
        $hashParts = $this->info($hashedValue);
        
        if(isset($options['salt']) && $hashParts['salt'] != $options['salt']){
            return true;
        }
        
        if(isset($optionp['rounds']) && $hashParts['rounds'] != $options['rounds']){
            return true;
        }
        
        return false;
    }
}
