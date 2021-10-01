<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalisationService
{
    protected $parameter = 'lang';

    /**
     * Разрешённый список локализаций
     * @var string[]
     */
    protected $localeWhiteList = [
        'en',
        'ru'
    ];

    /**
     * Получаем название локализации из запроса или из настроек
     * @param Request $request
     * @return string
     */
    public function getLocale(Request $request): ?string
    {
        $locale = $request->route()->parameter($this->parameter);
        if (empty($locale)) {
            $locale = $request->input($this->parameter);
        } else {
            $request->route()->forgetParameter($this->parameter);
        }
        if (empty($locale)) {
            $locale = App::getLocale();
        }
        return $locale;
    }

    /**
     * Проверяет валидность названия локализации
     * @param $locale
     * @return bool
     */
    public function isValid($locale): bool
    {
        return in_array($locale, $this->localeWhiteList);
    }

    /**
     * Устанавливает локаль
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        App::setLocale($locale);
    }
}
