<?php

class PrimeYearService implements IPrimeYearService
{

    private $repository;
    private $handler;

    public function __construct(IRepository $repository, IEncryptionHandler $handler)
    {
        $this->repository = $repository;
        $this->handler = $handler;
    }

    private function getYear($date)
    {
        $parts = explode('-', $date);

        return (int)$parts[0];
    }

    //If return == 0 this is not a prime number
    private function isPrimeNumber($number): int
    {
        for ($x = 2; $x < $number; $x++) {
            if ($number % $x == 0) {
                return false;
            }
        }
        return true;
    }

    //Find 30 prime numbers and insert them in the database
    public function insertPrimes($date): void
    {
        $year = $this->getYear($date);
        $i = 0;
        while ($i < 30 && $year > 0) {
            if ($this->isPrimeNumber($year)) {
                $christmas = $this->dayChristmas($year);
                $primeYear = new PrimeYear();
                $primeYear->day = $this->handler->encrypt($christmas);
                $primeYear->year = $year;
                $this->repository->insert($primeYear);
                $i++;
            }
            $year--;
        }
    }

    public function findAll()
    {
        $data = $this->repository->findAll("PrimeYear");

        foreach ($data as $element) {
            $element->day = $this->handler->decrypt($element->day);
        }

        return $data;
    }
    //Return the day on which christmas is on the given year
    private function dayChristmas($date): string
    {
        return date("l", mktime(0, 0, 0, 12, 25, $date));
    }
}
