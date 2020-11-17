<?php

namespace LexiConnInternetServices\ShaHashing\Hashers;

/**
 * Class Sha512Hasher
 */
class Sha512Hasher extends ShaHasher
{
    protected $prefix = '6';
    protected $saltLength = 16;
}
