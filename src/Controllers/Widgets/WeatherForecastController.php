<?php

namespace Firebed\News\Controllers\Widgets;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use Psr\Http\Client\ClientExceptionInterface;

class WeatherForecastController extends Controller
{
    private const URL = "https://forecast7.com/tr/41d1324d89/xanthi/";

    /**
     * @return JsonResponse
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws StrictException
     * @throws ClientExceptionInterface
     * @throws NotLoadedException
     */
    public function __invoke(): JsonResponse
    {
        $dom = new Dom;
        $dom->loadFromUrl(self::URL);

        $currentIcon = $dom->find('.current-icon .w-icon', 0);
//        $currentIcon->setAttribute('viewBox', '40 70 220 160');

        $currentConditions = $dom->find('.current-conditions', 0);
        $temp = $currentConditions->find('.temp');
        $summary = $currentConditions->find('.summary');

        return response()->json([
            'icon'    => $currentIcon->outerHTML,
            'temp'    => $temp->innerText,
            'summary' => $summary->innerText
        ]);
    }
}
