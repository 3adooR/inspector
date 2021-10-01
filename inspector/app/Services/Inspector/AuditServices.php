<?php

namespace App\Services\Inspector;

use App\Services\Inspector\Audits\CodeService;
use App\Services\Inspector\Audits\DomainService;
use App\Services\Inspector\Audits\IndexService;
use App\Services\Inspector\Audits\InfoService;
use App\Services\Inspector\Audits\KeywordsService;
use App\Services\Inspector\Audits\PrcyService;
use App\Services\Inspector\Audits\SeoService;
use App\Services\Inspector\Audits\ServerService;
use App\Services\Inspector\Audits\SitemapService;
use App\Services\Inspector\Audits\SpeedService;

class AuditServices
{
    const SERVICE_INFO = 'info';
    const SERVICE_DOMAIN = 'domain';
    const SERVICE_SERVER = 'server';
    const SERVICE_CODE = 'code';
    const SERVICE_SPEED = 'speed';
    const SERVICE_INDEX = 'index';
    const SERVICE_PRCY = 'prcy';
    const SERVICE_SITEMAP = 'sitemap';
    const SERVICE_KEYWORDS = 'keywords';
    const SERVICE_SEO = 'seo';

    /**
     * Получение объекта-сервиса для текущего аудита по его названию
     * @param string $name
     * @return CodeService|DomainService|IndexService|InfoService|KeywordsService|PrcyService|SeoService|ServerService|SitemapService|SpeedService
     */
    public function getServiceByName(string $name)
    {
        switch ($name) {
            case self::SERVICE_DOMAIN:
                $service = new DomainService;
                break;
            case self::SERVICE_SERVER:
                $service = new ServerService;
                break;
            case self::SERVICE_CODE:
                $service = new CodeService;
                break;
            case self::SERVICE_SPEED:
                $service = new SpeedService;
                break;
            case self::SERVICE_INDEX:
                $service = new IndexService;
                break;
            case self::SERVICE_PRCY:
                $service = new PrcyService;
                break;
            case self::SERVICE_SITEMAP:
                $service = new SitemapService;
                break;
            case self::SERVICE_KEYWORDS:
                $service = new KeywordsService;
                break;
            case self::SERVICE_SEO:
                $service = new SeoService;
                break;
            default:
                $service = new InfoService;
        }
        return $service;
    }

}
