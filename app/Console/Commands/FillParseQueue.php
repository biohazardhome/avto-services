<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

use App\Jobs\Parse;

class FillParseQueue extends Command
{
	
	const URL = 'http://www.plan1.ru/dolgoprudniy/avto/avtoservisyi/';
	
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $res = $client->request('GET', self::URL);
        //dd($res->getStatusCode());
        
        if ($res->getStatusCode() === 200) {
			$content = $res->getBody();
			
			$urls = $this->parse($content);
			//dd(function_exists('dispatch'));
			foreach ($urls as $url) {
                // continue;
                // dd($url);
				dispatch((new Parse($url))/*->onQueue('parse')*/);
			}
		}
    }
    
    public function parse($content) {
		$dom = new Crawler((string) $content);
		
		$urls = [];
			
		$contentNode = $dom->filter('#content');
		$contentNode->filter(
			'#spisok .fake-background-eb-div,
			.sb-n-non-rating-ent-div .nonRatingItem'
		)
			->each(function(Crawler $node, $i) use(&$urls) {
				$urls[] = $node->filter('.sp-n-nonrating-title a')
					->attr('href');
			});
			
		return $urls;
	}
}
