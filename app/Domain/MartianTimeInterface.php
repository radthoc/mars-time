<?php

namespace App\Domain;

interface MartianTimeInterface
{
    /**
     * @param string $milliseconds
     * @return array
     */
    public function getMartianTime(string $milliseconds): array;

    /**
     * @param float $marsSolDate
     * @return string
     */
    public function getMartianCoordinatedTime(float $marsSolDate): string;

    /**
     * @param int $millis
     * @return float
     */
    public function getMarsSolDate(int $millis): float;
}