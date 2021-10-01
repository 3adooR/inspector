<?php

namespace App\Services\Inspector\Audits;

use App\Http\Controllers\Controller;
use App\Models\Inspector\Code;
use App\Services\Inspector\InspectorService;
use IDM\LaravelHtmlValidator\Services\HtmlValidator;

class CodeService extends InspectorService
{
    /** @var HtmlValidator */
    protected HtmlValidator $htmlValidator;

    public function __construct()
    {
        $this->model = new Code;
    }

    public function hasResult(): bool
    {
        $data = $this->model::where(['site_id' => $this->site->id])->first();
        if (!empty($data)) {
            $this->setHtmlValidator();
            $this->viewData = [
                'link' => $this->htmlValidator->getLink(),
                'valid' => $data->valid,
                'errors' => $data->errors,
                'warnings' => $data->warnings
            ];
            $result = true;

        } else {
            $result = false;
        }
        return $result;
    }

    public function inspect(): void
    {
        $this->setHtmlValidator();
        $results = $this->htmlValidator->validate();
        if (!empty($results)) {
            $siteCode = $this->model::firstOrNew(['site_id' => $this->site->id]);
            $siteCode->valid = $results['isValid'] ?? false;
            $siteCode->errors = $results['errors'] ?? 0;
            $siteCode->warnings = $results['warnings'] ?? 0;
            $siteCode->save();
            $this->viewData = [
                'link' => $this->htmlValidator->getLink(),
                'valid' => $siteCode->valid,
                'errors' => $siteCode->errors,
                'warnings' => $siteCode->warnings
            ];
        }
    }

    protected function setHtmlValidator()
    {
        $url = 'http' . (($this->site->https) ? 's' : '') . '://' . $this->site->host;
        $this->htmlValidator = new HtmlValidator;
        $this->htmlValidator->setUrl($url);
    }
}
