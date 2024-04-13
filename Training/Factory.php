<?php

interface CarFactory{
    public function startCar();
}
abstract class Builder
{
     public function build()
    {
        echo "hello";
    }
}


class SportCar implements CarFactory
{
    public function startCar()
    {

    }
}
