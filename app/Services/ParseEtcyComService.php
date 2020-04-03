<?php

namespace App\Services\Categories;


use App\Helpers\GuzzleClientHelper;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\DomCrawler\Crawler;

class ParseEtcyComService
{
    private $guzzleClient;


    public function __construct()
    {
        $this->guzzleClient = new GuzzleClientHelper(config('etsy_com.url'));
    }

    public function getUrlsGift(int $page = null)
    {
        $links = [];
        foreach (config('etsy_com.groups') as $nameGroup => $urlList) {
            $url         = empty($page) ? $urlList : "$urlList.?ref=pagination&page=$page";
            $currentPage = $this->guzzleClient->request($url);
            if (!empty($currentPage)) {
                $links = array_merge($links, $this->getLinksFromCurrentPage($currentPage, $nameGroup));
            }
        }
        return $links;
    }

    private function getLinksFromCurrentPage(string $link, $nameGroup): array
    {
        $crawler = new Crawler($link);
        $links   = $crawler->filter('#search-results a')->each(function (Crawler $node) use ($nameGroup) {
            return ['group' => $nameGroup,
                    'url'   => $node->attr('href')];
        });
        return $links;
    }

    public function getInfoGift(string $url): array
    {
        $pageGift = $this->guzzleClient->request($url);
        $crawler  = new Crawler($pageGift);
        $img      = $crawler->filter('img.carousel-image')->attr('src');
        $title    = $crawler->filter('title')->text();
        logger()->info('get title' . $title);
        $tr = new GoogleTranslate();
        $tr->setSource('en');
        $tr->setTarget('ru');
        $patterns            = ['/[^а-яё\s]+/iu',
                                '/\s[А-Я]/u',
                                '/\s+/',
                                '/^\./'];
        $replacements        = ["",
                                ".\${0}",
                                " ",
                                ""];
        $titleWithOutEnglish = preg_replace($patterns, $replacements, $tr->translate($title));
        $arrTitles           = array_filter(array_unique(explode(' ', $titleWithOutEnglish)));
        return [
            'title' => implode(' ', $arrTitles),
            'img'   => $img
        ];
    }


}
