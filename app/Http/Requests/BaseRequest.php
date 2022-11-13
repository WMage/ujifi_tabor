<?php

namespace App\Http\Requests;

use App\Services\CastService;
use Illuminate\Routing\Route;

/**
 * Class BaseRequest
 */
abstract class BaseRequest extends \Illuminate\Http\Request
{
    private $valuesCache = [];
    protected $casts = [];

    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (!array_key_exists($key, $this->valuesCache)) {
            if (method_exists($this, ($method = 'get' . ucfirst($key) . 'Attribute'))) {
                $this->valuesCache[$key] = $this->$method();
            } else {
                $this->valuesCache[$key] = $this->get($key) ?: parent::__get($key);
            }
            if (isset($this->casts[$key])) {
                $this->valuesCache[$key] = CastService::cast($this->valuesCache[$key], $this->casts[$key]);
            }
        }
        return $this->valuesCache[$key];
    }

    public function get(string $key, $default = null)
    {
        $route = $this->route();

        if (!empty($route) && $route instanceof Route && $route->hasParameter($key)) {
            return $this->route($key, $default);
        }

        return parent::get('payload')[$key] ?? parent::get($key, $default);
    }

    public function post($key = null, $default = null)
    {
        return parent::post('payload')[$key] ?? parent::post($key, $default);
    }

    public function validate(): void
    {
        parent::validate(
            $this->rules(),
            ...[$this->query->all(),
                $this->request->all(),
                $this->attributes->all(),
                $this->cookies->all(),
                $this->files->all(),
                $this->server->all(),
                $this->getContent()]
        );
    }

    abstract public function rules(): array;
}