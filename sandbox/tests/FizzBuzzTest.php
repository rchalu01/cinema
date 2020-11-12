<?php

namespace App;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase{

    public function test_3_return_fizz(){
        $partie = new FizzBuzz();
        $this->assertSame("fizz", $partie->compte(3));
    }

    public function test_5_return_buzz(){
        $partie = new FizzBuzz();
        $this->assertSame("buzz", $partie->compte(5));
    }

    public function test_15_return_fizzbuzz(){
        $partie = new FizzBuzz();
        $this->assertSame("fizzbuzz", $partie->compte(15));
    }

    public function test_8_return_8(){
        $partie = new FizzBuzz();
        $this->assertSame(8, $partie->compte(8));
    }
}
