<?php

namespace App\Http\Controllers;

use App\Http\Response\ControllerResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Execute an action on the controller.
     *
     * @param  string $method
     * @param  array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        /** @var ControllerResponse $cr */
        $cr = $this->{$method}(...array_values($parameters));
        return ($cr->getResponse());
        dd($this->request->wantsJson());
        dd(app('request')->wantsJson());
        dd($this->request->wantsJson(), $cr);
    }
}
