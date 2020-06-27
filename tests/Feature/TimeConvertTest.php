<?php

namespace Tests\Feature;

use Tests\TestCase;

class TimeConvertTest extends TestCase
{
    public function testConvertTime()
    {
        $time = gmdate("M d Y H:i:s", 1593189933);
        $expectedResponse = [
            'msd' => 34145.242174162144,
            'mtc' => '05:48:43',
        ];

        $response = $this->json('GET', 'time/convert/' . $time)
            ->assertJson($expectedResponse);

        $this->assertEquals(200, $response->status());
    }
}
