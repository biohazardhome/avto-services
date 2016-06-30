<?php

namespace My\Model\Slug;

use Exception;

use Illuminate\Database\Eloquent\Model;

use My\Model\Slug\SlugOptions;

trait Slug {

	protected
		$slugOptions = null;

	abstract public function slugGenerate();

    public static function slugOptions() {
    	return new SlugOptions();
    }

	public static function bootSlug() {

		static::creating(function(Model $m) {
			$m->addSlug();
		});

		if (self::slugOptions()->regenerateOnUpdate) {
			static::updating(function(Model $m) {
				$m->addSlug();
			});
		}
	}

	public function addSlug() {
		$options = $this->slugOptions = $this->slugGenerate();

		$column = $this->slugOptions->slugColumn;

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
		return str_slug($this->{$this->slugOptions->generateFromColumn});
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
		return !(bool) $this->where($this->slugOptions->slugColumn, $slug)
			->where($this->getKeyName(), '!=', $this->getKey() ?: '0')
			->count();
	}

	public function slugValidate() {
		if (!strlen($this->slugOptions->generateFromColumn)) {
			throw InvalidOption::missingFromField();
        }
        if (!strlen($this->slugOptions->slugColumn)) {
            throw InvalidOption::missingSlugField();
        }
        if ($this->slugOptions->maxLength <= 0) {
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