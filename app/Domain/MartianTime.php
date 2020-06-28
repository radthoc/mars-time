<?php

namespace App\Domain;

use DateTime;
use DateTimeZone;
use Exception;

class MartianTime implements MartianTimeInterface
{
    /**
     * @param string $time
     * @return array
     * @throws Exception
     */
    public function getMartianTime(string $time): array
    {
        //TODO: Validate input
        //TODO: Extract date handling functions to a date helper
        $dateTime = new DateTime($time, new DateTimeZone('UTC'));
        $milliseconds = $dateTime->format('U');

        $marsSolDate = $this->getMarsSolDate($milliseconds);
        $martianCoordinatedTime = $this->getMartianCoordinatedTime($marsSolDate);

        return [
            'msd' => $marsSolDate,
            'mtc' => $martianCoordinatedTime
        ];
    }

    /**
     * @param int $millis
     * @return float
     */
    public function getMarsSolDate(int $millis): float
    {
        $julianDateUT = $this->calculateJulianDateUT($millis);
        $julianDateTT = $this->calculateJulianDateTT($julianDateUT);
        $terrestrialTimeOffset = $this->calculateTerrestrialTimeOffset($julianDateTT);

        return $this->calculateMarsSolDate($terrestrialTimeOffset);
    }

    /**
     * @param float $marsSolDate
     * @return string
     */
    public function getMartianCoordinatedTime(float $marsSolDate): string
    {
        $seconds = (86400 * $marsSolDate) % 86400;
        //TODO: Extract date handling functions to a date helper
        return gmdate("H:i:s", $seconds);
    }

    /**
     * @param int $millis
     * @return float
     */
    private function calculateJulianDateUT(int $millis): float
    {
        return 2440587.5 + ($millis / 86400000);
    }

    /**
     * @param float $julianDateUT
     * @return float
     */
    private function calculateJulianDateTT(float $julianDateUT): float
    {
        return $julianDateUT + (37 + 32.184) / 86400;
    }

    /**
     * @param float $julianDateTT
     * @return float
     */
    private function calculateTerrestrialTimeOffset(float $julianDateTT): float
    {
        return $julianDateTT - 2451545.0;
    }

    /**
     * @param float $terrestrialTimeOffset
     * @return float
     */
    private function calculateMarsSolDate(float $terrestrialTimeOffset): float
    {
        return (($terrestrialTimeOffset - 4.5) / 1.0274912517) + 44796 - 0.0009626;
    }
}