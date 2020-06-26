<?php

namespace Tests\Unit;

use App\Domain\MartianTime;
use Tests\TestCase;

class MartianTimeServiceTest extends TestCase
{
    /**
     * @var MartianTime
     */
    private $marsSolDateService;

    public function setup()
    {
        $this->marsSolDateService = new MartianTime();
    }

    public function testGetMarsSolDate()
    {
        $time = gmdate("M d Y H:i:s", 1593189933);
        $dateTime = new \DateTime($time, new \DateTimeZone('UTC'));
        $milliseconds = $dateTime->format('U');

        $expectedMarsSolDate = 34145.242174162144;

        $this->assertEquals($expectedMarsSolDate, $this->marsSolDateService->getMarsSolDate($milliseconds));
    }

    public function testGetMartianCoordinatedTime()
    {
        $marsSolDate = 52068.01284;
        $expectedMartianCoordinatedTime = '00:18:29';

        $this->assertEquals($expectedMartianCoordinatedTime,
            $this->marsSolDateService->getMartianCoordinatedTime($marsSolDate));
    }

    public function testGetMartianTime()
    {
        $time = gmdate("M d Y H:i:s", 1593189933);
        $expectedMartianTimeArray = [
            'msd' => 34145.242174162144,
            'mtc' => '05:48:43',
        ];

        $this->assertEquals($expectedMartianTimeArray, $this->marsSolDateService->getMartianTime($time));
    }
}
