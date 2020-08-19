<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class My_aes {
    private $key = '';
    public function __construct($key = '') {   
        $this->key = $key;
    }

    /**
     * @param string $key
     * @return string
     */
    function mysql_aes_key($key)
    {
        $new_key = str_repeat(chr(0), 16);
        for ($i = 0, $len = strlen($key); $i < $len; $i++) {
            $new_key[$i % 16] = $new_key[$i % 16] ^ $key[$i];
        }
        return $new_key;
    }

    /**
     * @param string $val
     * @param string $cypher
     * @param bool $mySqlKey
     * @return string
     * @throws \BadFunctionCallException
     */
    function encrypt($val, $cypher = null, $mySqlKey = true)
    {
        //$salt = getenv('SALT') ?: '1234567890abcdefg';
        $salt = $this->key;
        $key = $mySqlKey ? $this->mysql_aes_key($salt) : $salt;

        if (function_exists('mcrypt_encrypt')) {
            $cypher = (!$cypher || $cypher == strtolower('aes-128-ecb')) ? MCRYPT_RIJNDAEL_128 : $cypher;
            $pad_value = 16 - (strlen($val) % 16);
            $val = str_pad($val, (16 * (floor(strlen($val) / 16) + 1)), chr($pad_value));
            return @mcrypt_encrypt($cypher, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
        } elseif (function_exists('openssl_encrypt')) {
            //TODO: Create a more comprehensive map of mcrypt <-> openssl cyphers
            $cypher = (!$cypher || $cypher == MCRYPT_RIJNDAEL_128) ? 'aes-128-ecb' : $cypher;
            return openssl_encrypt($val, $cypher, $key, true);
        }

        throw new \BadFunctionCallException('No encryption function could be found.');
    }


    /**
     * @param string $val
     * @param string $cypher
     * @param bool $mySqlKey
     * @return string
     * @throws \BadFunctionCallException
     */
    function decrypt($val, $cypher = null, $mySqlKey = true)
    {
        $salt = getenv('SALT') ?: '1234567890abcdefg';
        $key = $mySqlKey ? $this->mysql_aes_key($salt) : $salt;

        if (function_exists('mcrypt_decrypt')) {
            $cypher = (!$cypher || $cypher == strtolower('aes-128-ecb')) ? MCRYPT_RIJNDAEL_128 : $cypher;
            $val = @mcrypt_decrypt($cypher, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
            return rtrim($val, chr(0)."..".chr(16));
        } elseif (function_exists('openssl_decrypt')) {
            //TODO: Create a more comprehensive map of mcrypt <-> openssl cyphers
            $cypher = (!$cypher || $cypher == MCRYPT_RIJNDAEL_128) ? 'aes-128-ecb' : $cypher;
            return openssl_decrypt($val, $cypher, $key, true);
        }

        throw new \BadFunctionCallException('No decryption function could be found.');
    }
}
?>