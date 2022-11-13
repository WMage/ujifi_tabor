<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminTraits\CsoportKezelesTrait;
use App\Http\Controllers\AdminTraits\TaborKezelesTrait;
use App\Http\Controllers\AdminTraits\VerzioKezelesTrait;
use App\Http\Response\ControllerResponse;
use App\Repositories\TaborRepository;
use App\Models\User;

class AdminController extends Controller
{
    use CsoportKezelesTrait;
    use TaborKezelesTrait;
    use VerzioKezelesTrait;

    protected User $user;

    protected function getUser(): User
    {
        if (empty($this->user)) {
            /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
            $this->user = auth()->user();
        }
        return $this->user;
    }

    /**
     * @return ControllerResponse
     * @throws \ReflectionException
     */
    public function index()
    {
        $user = $this->getUser();
        $tabor_list = $user->taborok;
        $tabor_id = TaborRepository::getInstance()->getKijeloltTaborId();
        return new ControllerResponse('home', compact('tabor_list', 'tabor_id'));
    }
}
