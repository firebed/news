<?php

namespace Firebed\News\Controllers\Widgets;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use PHPHtmlParser\Dom;
use Throwable;

class PrayerTimeController extends Controller
{
    private const URL = "https://namazvakitleri.com.tr/sehir/5379/ISKECE-xanthi/YUNANISTAN/";

    /**
     * @throws Throwable
     */
    public function __invoke(): JsonResponse
    {
        $dom = new Dom;
        $dom->loadFromUrl(self::URL);

        $monthlyTable = $dom->find('[next-time]', 0);

        $now = now();
        [$prayer, $time] = $this->getNextPrayer($monthlyTable, $now);
        if ($prayer !== null) {
            return response()->json(compact('prayer', 'time'));
        }

        $tomorrow = now()->addDay()->startOfDay();
        [$prayer, $time] = $this->getNextPrayer($monthlyTable, $tomorrow);
        if ($prayer !== null) {
            return response()->json(compact('prayer', 'time'));
        }

        return response()->json([
            'prayer' => '',
            'time'   => ''
        ]);
    }

    private function getNextPrayer($table, Carbon $offset): array|null
    {
        $header = $table->find('thead tr', 0);
        $body = $table->find('tbody', 0);

        foreach ($body->getChildren() as $tableRow) {
            $date = trim($tableRow->firstChild()->innerText);
            if (!$offset->isSameDay($date)) {
                continue;
            }

            foreach ($tableRow->getChildren() as $index => $tableColumn) {
                $time = trim($tableColumn->innerText);
                if (!strpos($time, ':')) {
                    continue;
                }

                $prayerDate = $offset->copy()->setTime(...explode(':', $time));

                if ($offset->lt($prayerDate)) {
                    $prayer = $header->find('th', $index);
                    return [trim($prayer->innerText) . ' vakti', $prayerDate->format('H:i')];
                }
            }
        }

        return null;
    }
}
