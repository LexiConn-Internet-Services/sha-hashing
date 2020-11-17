<?php

namespace LexiConnInternetServices\ShaHashing\Hashers;

/**
 * Class Sha256Hasher
 */
class Sha256Hasher extends ShaHasher
{
    protected $prefix = '5';
    protected $saltLength = 16;
}
