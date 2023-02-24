<?php

declare(strict_types=1);

namespace KMartins\CourseFinder;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Finder
{
    private ClientInterface $httpClient;
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        $html = $response->getBody();
        $this->crawler->addHtmlContent($html->__toString());

        $courseElements = $this->crawler->filter('span.card-curso__nome');

        $courses = [];

        foreach ($courseElements as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
