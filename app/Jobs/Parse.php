<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

use App\Catalog;
use App\Image;
use Storage;

class Parse extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    const URL = 'http://www.plan1.ru';
    const DIR = 'images/catalog';
    
    protected
		$url = '',
		$storage = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->storage = Storage::disk('public-images');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$client = new Client();
		$res = $client->request('GET', self::URL . $this->url);
		if ($res->getStatusCode() === 200) {
			$content = (string) $res->getBody();
			
			$dom = new Crawler($content);
			$contentNode = $dom->filter('#content #spisok');
			
			$columnNode = $contentNode->filter('#column');
			#dd($columnNode->filter('.sp-n-rating-content .sp-n-rating-content-lb .sp-n-rating-content a')->text());
			$columnInfoNode = $columnNode->filter('.sp-n-rating-content .sp-n-rating-content-lb');
			
			$contentNode = $contentNode->filter('.promo-page-content-div');
			$content = $contentNode->html();
			
			$address = $columnInfoNode->filter('.sp-n-ads-rate a');
			$address = $address->count() ? $address->text() : null;
			
			$phones = $columnInfoNode->filter('.sp-n-phones img');
			$phones = $phones->count() ? $phones->attr('title') : null;
			
			$email = $columnInfoNode->filter('.sp-n-email a');
			$email = $email->count() ? $email->text() : null;
			
			$site = $columnInfoNode->filter('.sp-n-site a');
			$site = $site->count() ? $site->text() : null;
			#dd($contentNode->filter('img'));
			
			$images = $contentNode->filter('img')->each(function(Crawler $node, $i) { return $node->attr('src'); });
			
			$item = [
				'title' => $columnNode->filter('h1')->text(),
				'content' => $content,
				'description' => $columnNode->filter('.sp-n-rating-content > div')->text(),
				'address' => $address,
				'phones' => $phones,
				'email' => $email,
				'site' => $site,
				//'images' => $images,
			];
			
			$catalog = $this->createCatalogItem($item);
			$images = $this->saveImages($images, $catalog->slug, $catalog->id);
			
			$content = $this->replaceImageInContent($contentNode, $images);
			Catalog::find($catalog->id)
				->update(['content' => $content]);
			
		} else {
			echo 'Not load';
		}
        
    }
    
    public function createCatalogItem($item) {
		$item['name'] = $item['title'];
		$item['slug'] = str_slug($item['name']);
		
		$item['slug'] = $this->catalogUniqueSlug($item['slug']);
		
		$item = array_except($item, ['title']);
		
		return Catalog::create($item);
	}
	
	public function catalogUniqueSlug($slug) {
		$newSlug = $slug;
		$i = 2;
		while (Catalog::whereSlug($newSlug)->count() !== 0) {
			$newSlug = $slug .'-'. $i;
			$i++;
		}
		return $newSlug;
	}
		
    
    public function saveImages(array $images, $name, $catalogId) {
		$imagesPath = [];
		$storage = $this->storage;
		
		/*$dir = storage_path('app/public/images');
		if (!$storage->exists($dir)) {
			echo 'Not exists dir images';
			$storage->makeDirectory($dir, 777, true);
		}*/
		
		foreach($images as $image) {
			if ($storage->exists($name)) {
				$storage->makeDirectory($name);
			}
			$pathfile = $name .'/'. basename($image);
			$pathfile = $this->renameImage($pathfile, $name);
			$pathfile = $this->uniqueNameImage($pathfile);
			dump($pathfile);
			$storage->put($pathfile, file_get_contents(/*self::URL . */$image));
			$imagesPath[] = $pathfile;
			
			/*Image::create([
				'path' = $pathinfo,
				'imageable_type' => 'catalog',
				'imageable_id' => $catalogId 
			]);*/
			//dd();
		}
		
		return $imagesPath;
	}
	
	public function renameImage($pathfile, $name) {
		$ext = pathinfo($pathfile, PATHINFO_EXTENSION);
		return dirname($pathfile) .'/'. $name .'.'. $ext;
	}
	
	public function uniqueNameImage($pathfile) {
		$pathinfo = pathinfo($pathfile);
		list($dir, $basename, $ext, $filename) = array_values($pathinfo);
		/*$dir = $pathinfo['dirname'];
		$filename = $pathinfo['filename'];
		$ext = $pathinfo['extension'];*/
		
		//dump($dir, $ext, $filename);
		
		$i = 0;
		//while (file_exists($pathfile)) {
		while ($this->storage->exists($pathfile)) {
			$pathfile = $dir .'/'. $filename .'-'. $i .'.'. $ext;
			$i++;
		}
		//dump($pathfile, file_exists($pathfile));
		//return $this->renameImage($pathfile, $filenameNew);
		return $pathfile;
	}
	
	public function replaceImageInContent(Crawler $content, $images) {
		$content->filter('img')->each(function(Crawler $node, $i) use($images) {
			$node->getNode(0)->setAttribute('src', '/images/catalog/'. $images[$i]);
		});
		return $content->html();
	}
	
	//public function make
    
    public function failed() {
		
	}
}
