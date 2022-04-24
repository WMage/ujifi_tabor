<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.24.
 * Time: 13:55
 */

namespace App\Http\Response;

use App\Http\Resources\Json\Tabor\Admin\CsoportResource;

class ControllerResponse
{
    private $responsePath;
    private $responseParams;

    /**
     * ControllerResponse constructor.
     * @param $responsePath
     * @param $responseParams
     */
    public function __construct($responsePath, $responseParams)
    {
        $this->responsePath = $responsePath;
        $this->responseParams = $responseParams;
    }

    /**
     * @param bool $wantsJson
     * @return mixed
     */
    public function getResponse(bool $wantsJson = false)
    {
        if ($wantsJson) {
            $class = "App\Http\Resources\Json\\";
            $parts = explode(".", $this->responsePath);
            $c = count($parts) - 1;
            for ($i = 0; $i < $c; $i++) {
                $class .= ucfirst($parts[$i]) . "\\";
            }
            $class .= ucfirst($parts[$c]) . "Resource";
            return new $class($this->responseParams);
        }
        return view($this->responsePath, $this->responseParams);
    }

}