<?php

class DatesController
{
    private $primeYearService;

    public function __construct(IPrimeYearService $primeYearService)
    {
        $this->primeYearService = $primeYearService;
    }

    public function index()
    {
        require 'views/index.view.php';
    }
    public function table()
    {
        $data = $this->primeYearService->findAll();

        echo json_encode(new TableModel($data));
    }

    public function dates() 
    {
        if (isset($_POST['date']) && !empty($_POST)) {
            try {
                //Filtering the input
                $date = ValidateInput::filter_input($_POST['date']);
                //Find and insert prime years
                $this->primeYearService->insertPrimes($date);

                require 'views/index.view.php';
            } catch (Exception $ex) {
                http_response_code(500);
                echo "Internal error. Please try again later";
            }
        }
        else{
            http_response_code(400);
            echo "Bad request";
        }
    }
}
