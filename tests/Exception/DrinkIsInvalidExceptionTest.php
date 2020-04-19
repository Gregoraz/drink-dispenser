<?php declare(strict_types=1);


namespace Tests\Exception;

use PHPUnit\Framework\TestCase;
use App\Exception\DrinkIsInvalidException;

class DrinkIsInvalidExceptionTest extends TestCase
{
    public function testIsExceptionThrown(): void
    {
        $this->expectException(DrinkIsInvalidException::class);
        throw new DrinkIsInvalidException('');
    }

    public function testInheritsFromException(): void
    {
        $exception = new DrinkIsInvalidException('');
        $pass = false;
        if(is_subclass_of($exception, 'Exception')) $pass = true;
        $this->assertEquals(true,$pass);
    }

}