<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use KMartins\CourseFinder\Finder;

$client = new Client(['base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$finder = new Finder($client, $crawler);
$course = $finder->search('/cursos-online-programacao/php');

foreach($course as $index => $course) {
    echo "[ $index ] - $course" . PHP_EOL;
}