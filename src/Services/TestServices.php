<?php


namespace App\Services;



class TestServices
{
    private $kyrs = 60;
    public function convert ($rub)
    {
        return $rub / $this->kyrs;
    }

}