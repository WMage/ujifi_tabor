<?php

namespace App\Http\Controllers;

use App\Exceptions\Kiirathato\ControllerException;
use App\Http\Response\ControllerResponse;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Factory;
use Illuminate\View\View;

class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var Request|BaseRequest $req */
    protected $req;

    /**
     * if defined, all controller action request passed validated by this,
     * also replaces $req value
     * @var Request|string $validatorReq
     */
    protected $validatorReq;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->req = $request;
    }


    /**
     * Execute an action on the controller.
     *
     * @param  string $method
     * @param  array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ControllerException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function callAction($method, $parameters)
    {
        $this->validateWith();
        $cr = $this->{$method}(...array_values($parameters));
        if ($cr instanceof ControllerResponse) {
            $cr = ($cr->getResponse(app('request')->wantsJson()));
        }
        //\Session::flash('error','error');
        /** @var View|Redirect|Response|mixed $cr */
        return $cr;
    }

    /**
     * @param null|string|Request $validatorClass
     * @throws ControllerException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function validateWith(?string $validatorClass = null): void
    {
        if (empty($validatorClass = $validatorClass ?: $this->validatorReq)) {
            throw new ControllerException('nincs validator');
        }
        if ($this->req->method() === 'GET') {
            return;
        }
        $this->req = (new $validatorClass($this->req->all()));
        app(Factory::class)->make($this->req->all(),$this->req->rules())->validate();

    }
}
