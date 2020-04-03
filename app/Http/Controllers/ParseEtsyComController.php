<?php

namespace App\Http\Controllers;

use App\Jobs\SaveInfoGiftJob;
use App\Models\Gift;
use App\Services\Categories\ParseEtcyComService;
use Illuminate\Http\Request;

class ParseEtsyComController extends Controller
{

    private $parseEtsyService;

    public function __construct(ParseEtcyComService $parseEtsyService)
    {
        $this->parseEtsyService = $parseEtsyService;
    }


    public function runParseUrlGift(Request $request)
    {
        $page    = $request->page;
        $gift    = new Gift();
        $links   = $this->parseEtsyService->getUrlsGift($page);
        $counter = 0;
        foreach ($links as $key => $link) {
            preg_match("/\/\d+\//", $link['url'], $etsyIdGift);
            if (empty($gift->where('url', 'like', '%' . $etsyIdGift[0] . '%')->first())) {
                $counter++;
                $gift->create($links[$key]);
            }
        }

        dump('Cтраниц с идеями добавлено: ' . $counter);
        dump('Всего страниц с идеями: ' . $gift->all()->count());
    }

    public function runParseGift()
    {
        $gift  = new Gift();
        $gifts = $gift->where('title', null)->get();
        $i     = 0;
        foreach ($gifts as $gift) {
            SaveInfoGiftJob::dispatch($gift)->delay(now()->addSeconds(++$i * 5));
//            $this->dispatch($job);
        }
        dd("Новых подарков в очереди парсера: {$gifts->count()}");
    }


}
