<?php

namespace App;
class FizzBuzz{

    /*Test si le nombre est un multiple de 3 et 5, de 3, de 5 ou d'aucun*/
    public function compte($number){
        if($number%3==0){
            if($number%5==0){
                return "fizzbuzz";
            }
            return "fizz";
        }
        if($number%5==0){
            return "buzz";
        }
        return $number;
    }
}