<?php

namespace App\Services\Inspector;

class MenuService
{
    public $menu = [];

    public function __construct()
    {
        if (empty($this->menu)) {
            $this->setMenu();
        }
    }

    /**
     * Формирование меню аудитов
     * @return array[]
     */
    public function setMenu(): array
    {
        $this->menu = [
            [
                'name' => __('app.inspector_tech'),
                'items' => [
                    [
                        'name' => AuditServices::SERVICE_INFO,
                        'icon' => 'info-circle',
                        'title' => __('app.inspector_tech_info')
                    ],
                    [
                        'name' => AuditServices::SERVICE_DOMAIN,
                        'icon' => 'globe-americas',
                        'title' => __('app.inspector_tech_domain')
                    ],
                    [
                        'name' => AuditServices::SERVICE_SERVER,
                        'icon' => 'server',
                        'title' => __('app.inspector_tech_server')
                    ],
                    [
                        'name' => AuditServices::SERVICE_CODE,
                        'icon' => 'code',
                        'title' => __('app.inspector_tech_code')
                    ],
                    [
                        'name' => AuditServices::SERVICE_SPEED,
                        'icon' => 'tachometer-alt',
                        'title' => __('app.inspector_tech_speed')
                    ],
                ]
            ],
            [
                'name' => __('app.inspector_seo'),
                'items' => [
                    [
                        'name' => AuditServices::SERVICE_INDEX,
                        'icon' => 'robot',
                        'title' => __('app.inspector_seo_index')
                    ],
                    [
                        'name' => AuditServices::SERVICE_PRCY,
                        'icon' => 'check-circle',
                        'title' => __('app.inspector_seo_prcy')
                    ],
                    [
                        'name' => AuditServices::SERVICE_SITEMAP,
                        'icon' => 'sitemap',
                        'title' => __('app.inspector_seo_sitemap')
                    ],
                    [
                        'name' => AuditServices::SERVICE_KEYWORDS,
                        'icon' => 'file-alt',
                        'title' => __('app.inspector_seo_keywords')
                    ],
                    [
                        'name' => AuditServices::SERVICE_SEO,
                        'icon' => 'search',
                        'title' => __('app.inspector_seo_full')
                    ],
                ]
            ],
            /*[
                'name' => __('app.inspector_usability'),
                'items' => [
                    [
                        'name' => 'usability',
                        'icon' => 'eye',
                        'title' => __('app.inspector_usability_audit')
                    ],
                ]
            ],*/
        ];
        return $this->menu;
    }

    /**
     * Формирование массива меню "Ключ => Название"
     * @return array
     */
    public function getMenuNames(): array
    {
        $menuNames = [];
        foreach ($this->menu as $menuBlock) {
            foreach ($menuBlock['items'] as $menu) {
                $name = $menu['name'];
                $title = $menu['title'];
                $menuNames[$name] = $title;
            }
        }
        return $menuNames;
    }

    /**
     * Формирование массива меню "Ключ => Название"
     * @return array
     */
    public function getMenuIcons(): array
    {
        $menuIcons = [];
        foreach ($this->menu as $menuBlock) {
            foreach ($menuBlock['items'] as $menu) {
                $name = $menu['name'];
                $icon = $menu['icon'];
                $menuIcons[$name] = $icon;
            }
        }
        return $menuIcons;
    }

    /**
     * Получение названия пункта меню по ключу
     * @param string $menu
     * @return string
     */
    public function getMenuName(string $menu): string
    {
        $menuNames = $this->getMenuNames();
        return $menuNames[$menu] ?? '';
    }

    /**
     * Получение названия пункта меню по ключу
     * @param string $menu
     * @return string
     */
    public function getMenuIcon(string $menu): string
    {
        $menuIcons = $this->getMenuIcons();
        return $menuIcons[$menu] ? '<i class="fas fa-' . $menuIcons[$menu] . '"></i>' : '';
    }

    public function getNextMenuName(string $menu): string
    {
        $num = 0;
        $menuArray = [];
        foreach ($this->menu as $menuBlock) {
            foreach ($menuBlock['items'] as $menuItem) {
                $num++;
                $menuArray[$num] = $menuItem['name'];
            }
        }
        $currentNum = array_search($menu, $menuArray);
        $nextNum = $currentNum + 1;
        return ($menuArray[$nextNum]) ?? '';
    }
}
