<?php

interface IEncryptionHandler{
    public function  encrypt(string $var);
    public function  decrypt(string $var);
}