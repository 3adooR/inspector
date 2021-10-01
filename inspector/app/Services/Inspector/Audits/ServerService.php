<?php

namespace App\Services\Inspector\Audits;

use App\Models\Inspector\Server;
use App\Services\Inspector\InspectorService;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class ServerService extends InspectorService
{
    public function __construct()
    {
        $this->model = new Server;
    }

    public function hasResult(): bool
    {
        $data = $this->getCacheData();
        if (empty($data)) {
            $data = $this->model::where(['site_id' => $this->site->id])->first();
        }
        if (!empty($data)) {
            $this->setCacheData($data);
            $this->viewData = [
                'ip' => $data->ip,
                'lat' => $data->lat,
                'long' => $data->long,
                'data' => json_decode($data->data, true)
            ];
            return true;
        } else {
            return false;
        }
    }

    /**
     * Получение данных о сервере (ipgeobase)
     */
    public function inspect(): void
    {
        $ip = gethostbyname($this->site->host);
        $rq = Http::get("http://ipgeobase.ru:7020/geo?ip=" . $ip);
        $rs = $rq->body();
        if (!empty($rs)) {
            $xml = new SimpleXMLElement($rs);
            if (isset($xml->ip)) {
                $siteServer = $this->model::firstOrNew(['site_id' => $this->site->id]);
                $siteServer->ip = $ip;
                $siteServer->lat = $xml->ip->lat ?? 0;
                $siteServer->long = $xml->ip->lng ?? 0;
                $siteServer->data = json_encode($xml->ip);
                $siteServer->save();
                $this->viewData = [
                    'ip' => $siteServer->ip,
                    'lat' => $siteServer->lat,
                    'long' => $siteServer->long,
                    'data' => json_decode($siteServer->data, true)
                ];
            }
        }
    }
}
