<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/7/2020
 * Time: 8:47 PM
 */

//namespace UnitTests;
use PHPUnit\Framework\TestCase;
class UserTest extends TestCase
{
    public function testCanJoinMultipleChannels():void{
        $stub = $this->createStub(\User::class);

        $stub->method('subscribe')
            ->willReturn('list updated');
        $this->assertSame('list updated',$stub->subscribe(['1','2']));
    }
}