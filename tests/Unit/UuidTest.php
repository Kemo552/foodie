<?php

namespace Tests\Unit;

use App\Http\Controllers\GeneralUtils;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;

class UuidTest extends TestCase
{
    public function test_uuid_is_returned_successfully(): void
    {
        $uuid = GeneralUtils::uuid();
        $this->assertEquals(36, strlen($uuid));
        $this->assertTrue(Str::isUuid($uuid));
    }
}