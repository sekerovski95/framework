<?php
interface IPrimeYearService
{
    public function insertPrimes(int $date):void;
    public function findAll();
}