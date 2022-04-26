<?php

namespace App\Http\Controllers;

use App\Http\Response\ControllerResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        $cr = $this->{$method}(...array_values($parameters));
        if ($cr instanceof ControllerResponse) {
            $cr = ($cr->getResponse(app('request')->wantsJson()));
        }
        //\Session::flash('error','error');
        /** @var View|Redirect|Response|mixed $cr */
        return $cr->with('error', 'You have no permission for this page!');
    }
}
