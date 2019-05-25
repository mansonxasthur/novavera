<?php
/**
 * Created by PhpStorm.
 * admin: Manson
 * Date: 2/1/2019
 * Time: 5:40 PM
 */

namespace App\Traits;


use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'ar';

    /**
     * Set has many relationship for the called eloquent model
     *
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(get_class() . 'Translation');
    }

    /**
     * @param array $translations
     * @param string $locale
     *
     * @return void
     */
    public function addTranslation(array $translations, string $locale = null): void
    {
        $locale = $locale ?? $this->defaultLocale;
        $filteredTranslations = [];
        foreach ($translations as $key => $value) {
            if ($value) $filteredTranslations[$key] = $value;
        }
        $this->translation()->create(array_merge(['locale' => $locale], $filteredTranslations));
    }

    /**
     * @param array $translations
     *
     * @return void
     */
    public function updateTranslation(array $translations): void
    {
        if ($this->translation()->first()) {
            $filteredTranslations = [];
            foreach ($translations as $key => $value) {
                if ($value) $filteredTranslations[$key] = $value;
            }
            empty($filteredTranslations) ?: $this->translation()->update($filteredTranslations);
        } else {
            $this->addTranslation($translations);
        }
    }
}