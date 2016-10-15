<?php

namespace My\Model\Slug;

use Exception;

use Illuminate\Database\Eloquent\Model;

use My\Model\Slug\SlugOptions;

trait Slug {

	protected static
		$slugOptions = null;

	abstract  public function slugGenerate();

    public static function slugOptions() {
    	return new SlugOptions();
    }

	public static function bootSlug() {
		self::$slugOptions = self::slugGenerate();

		static::creating(function(Model $m) {
			$m->addSlug();
		});

		static::updating(function(Model $m)  {
			if ($m->getSlugOptions()->regenerateOnUpdate) {

				$m->addSlug();
			}
		});
		
	}

	public function addSlug() {
		$column = static::$slugOptions->slugColumn;

		$slug = $this->generateSlug();
		if ($slug === '') {
			echo 'Empty slug';
		}
		// dd($slug, $this->slugIsUnique($slug));
		if (!$this->slugIsUnique($slug)) {
			$slug = $this->generateSlugUnique($slug);
			echo 'No Unique slug';
		}

		$this->{$column} = $slug;
	}

	public function generateSlug() {
		return str_slug($this->{static::$slugOptions->generateFromColumn});
	}

	public function generateSlugUnique($slug) {
		$originalSlug = $slug;
        $i = 1;

        while (!$this->slugIsUnique($slug)/* || $slug === ''*/) {
            $slug = $originalSlug .'-'. $i++;
        }
        return $slug;
	}

	public function slugIsUnique($slug) {
		return !(bool) $this->where(static::$slugOptions->slugColumn, $slug)
			->where($this->getKeyName(), '!=', $this->getKey() ?: '0')
			->count();
	}

	public function getSlugOptions() {
		return self::$slugOptions;
	}

	public function slugValidate() {
		if (!strlen(static::$slugOptions->generateFromColumn)) {
			throw InvalidOption::missingFromField();
        }
        if (!strlen(static::$slugOptions->slugColumn)) {
            throw InvalidOption::missingSlugField();
        }
        if (static::$slugOptions->maxLength <= 0) {
            throw InvalidOption::invalidMaximumLength();
        }
	}

}




class InvalidOption extends Exception
{
    public static function missingFromField()
    {
        return new static('Could not determinate which fields should be sluggified');
    }
    public static function missingSlugField()
    {
        return new static('Could not determinate in which field the slug should be saved');
    }
    public static function invalidMaximumLength()
    {
        return new static('Maximum length should be greater than zero');
    }
}