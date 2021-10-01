<?php

namespace App\Services\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

abstract class InspectorService extends Controller
{
    public $site;
    public $model;
    public $viewName = '';
    public $viewData = [];

    /**
     * Получение данных и запись в БД
     */
    public function inspect(): void
    {
        // логика получения и записи данных
    }

    /**
     * Отображаемый результат
     * @return string
     */
    public function result(): string
    {
        return view('audits.' . $this->viewName, $this->viewData)->render();
    }

    /**
     * Проверка наличия результата в БД
     * @return bool
     */
    public function hasResult(): bool
    {
        // логика проверки наличия данных
        return true;
    }

    /**
     * Сохранение результата в кеш
     * @param $data
     */
    public function setCacheData($data)
    {
        Cache::put('site-' . $this->site->id . '-' . $this->viewName, $data, env('CACHE_TTL'));
    }

    /**
     * Получение результата из кеша
     * @return mixed
     */
    public function getCacheData()
    {
        return Cache::get('site-' . $this->site->id . '-' . $this->viewName);
    }
}
