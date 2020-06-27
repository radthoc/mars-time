<?php

namespace App\Http\Controllers;

use App\Domain\MartianTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimeController extends Controller
{
    /** @var MartianTimeInterface */
    private $martianTimeService;

    public function __construct(MartianTimeInterface $martianTimeService)
    {
        $this->martianTimeService = $martianTimeService;
    }

    /**
     *
     * @param string $time
     * @return Response
     */
    public function __invoke(string $time)
    {
        return response()->json($this->martianTimeService->getMartianTime($time));
    }
}
