<?php

class EncryptionHandler implements IEncryptionHandler
{

    // Store the cipher method 
    private static $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method 
    private static $options = 0;

    // Non-NULL Initialization Vector for encryption 
    private static $encryption_iv = '1234567891011121';

    // Store the encryption key 
    private static $encryption_key = "GeeksforGeeks";


    public function encrypt(String $text)
    {
        // Use openssl_encrypt() function to encrypt the data 
        return $encryption = openssl_encrypt(
            $text,
            self::$ciphering,
            self::$encryption_key,
            self::$options,
            self::$encryption_iv
        );
    }

    public function decrypt(String $encryption)
    {
        // Use openssl_decrypt() function to decrypt the data 
        return $decryption = openssl_decrypt(
            $encryption,
            self::$ciphering,
            self::$encryption_key,
            self::$options,
            self::$encryption_iv
        );
    }
}
