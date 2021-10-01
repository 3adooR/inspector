<?php

namespace App\Services\Inspector\Audits;

use App\Models\Inspector\Domain;
use App\Services\Inspector\InspectorService;
use App\Services\Whois\WhoisService;

class DomainService extends InspectorService
{
    public function __construct()
    {
        $this->model = new Domain;
    }

    public function hasResult(): bool
    {
        $data = $this->getCacheData();
        if (empty($data)) {
            $data = $this->model::select('data')->where(['site_id' => $this->site->id])->first();
        }
        if (!empty($data)) {
            $this->setCacheData($data);
            $this->viewData = ['data' => json_decode($data->data, true)];
            return true;
        } else {
            return false;
        }
    }

    public function inspect(): void
    {
        $result = [];
        $domain = $this->getRootDomain($this->site->host);
        if (!empty($domain)) {
            $whois = new WhoisService($domain);
            if ($whois->isAvailable()) {
                $result['message'] = 'Доменное имя свободно';
            } else {
                $data = $this->getWhoisData($whois->htmlInfo());
                $result = !empty($data) ? $data : 'Нет данных';
            }
        }
        if (!empty($result)) {
            $siteDomain = $this->model::firstOrNew(['site_id' => $this->site->id]);
            $siteDomain->data = json_encode($result);
            $siteDomain->save();
            $this->viewData = ['data' => json_decode($siteDomain->data, true)];
        }
    }

    /**
     * Получение корневого домена (второго уровня)
     * @param string $host
     * @return string
     */
    private function getRootDomain(string $host): string
    {
        $domain = rtrim($host, '.');
        $domainParts = explode('.', $domain);
        if ($domainParts) {
            $domainPartsCount = count($domainParts);
            if ($domainPartsCount != 2) {
                $i = 0;
                krsort($domainParts);
                foreach ($domainParts as $part) {
                    $i++;
                    if ($i <= 2) $newParts[] = $part;
                }
                if (isset($newParts[1]) && isset($newParts[0])) {
                    $domain = $newParts[1] . '.' . $newParts[0];
                }
            }
        }
        return $domain;
    }

    /**
     * Массив обрабатываемых параметров в ответе WHOIS
     * @return string[]
     */
    private function whoisParameters(): array
    {
        return [
            'domain' => 'Доменное имя',
            'Domain Name' => 'Доменное имя',
            'nserver' => 'Хостинг',
            'Name Server' => 'Хостинг',
            'registrar' => 'Регистратор',
            'Registrar' => 'Регистратор',
            'created' => 'Зарегистрирован',
            'Creation Date' => 'Зарегистрирован',
            'paid-till' => 'Оплачен до',
            'Updated Date' => 'Оплачен до',
            'free-date' => 'Дата освобождения',
            'Registry Expiry Date' => 'Дата освобождения'
        ];
    }

    /**
     * Получение массива параметров в ответе WHOIS
     * @param string $html
     * @return array
     */
    private function getWhoisData(string $html): array
    {
        $result = [];
        $htmlAR = explode('<br />', $html);
        $parameters = $this->whoisParameters();
        if (!empty($htmlAR)) {
            foreach ($htmlAR as $ln) {
                $lnAR = explode(':', $ln);
                if (!empty($lnAR) && !empty($lnAR[0]) && !empty($lnAR[1])) {
                    $prmName = trim($lnAR[0]);
                    $prmVal = trim($lnAR[1]);
                    if ($prmName && $prmVal && isset($parameters[$prmName])) {
                        $result[$prmName] = [
                            'name' => [
                                'ru' => $parameters[$prmName],
                                'en' => ucfirst($prmName)
                            ],
                            'value' => $prmVal
                        ];
                    }
                }
            }
        }
        return $result;
    }
}
