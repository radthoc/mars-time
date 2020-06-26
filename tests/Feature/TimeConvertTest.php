<?php

namespace Tests\Feature;

use Tests\TestCase;

class TimeConvertTest extends TestCase
{
    public function testConvertTime()
    {
        $time = gmdate("M d Y H:i:s");

        $response = $this->json('GET', 'time/convert/' . $time)
            ->assertJson([
                'time' => $time
            ]);

        $this->assertEquals(200, $response->status());
    }
}
