<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 19:59
 */

/** @var \Illuminate\Support\Collection|\App\Models\Csoport[] $csoportok */
/** @var \Illuminate\Support\Collection|\App\Models\Jelentkezo[] $jelentkezok */
/** @var \Illuminate\Support\Collection|\App\Models\Jelentkezo[] $csopvez */
use \App\Service\Template;

?>
@extends('layouts.app')

@section('content')
    @if(userCan("groups.view"))
        @if(userCan("groups.manage", true))
            <h3>@lang('csoport.uj_csoport')</h3>
            <form method="post" action="">
                <table border="1">
                    <tr>
                        <td>@lang('altalanos.nev')</td>
                        <td>
                            <input name="csoport_nev" title="csoport_nev" value="{{oldV('csoport_nev')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.csoport_hely')</td>
                        <td>
                            <input name="csoport_hely" title="csoport_hely" value="{{oldV('csoport_hely')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.vezeto') 1</td>
                        <td>
                            <?= Template::generateSelect(
                                "csoport_vezeto1",
                                $jelentkezok,
                                oldV('csoport_vezeto1'),
                                ["ID", "getTeljesNev"]
                            )?>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.vezeto') 2</td>
                        <td>
                            <?= Template::generateSelect(
                                "csoport_vezeto2",
                                $csopvez,
                                oldV('csoport_vezeto2'),
                                ["ID", "getTeljesNev"]
                            )?>
                        </td>
                    </tr>
                </table>
            </form>
        @endif
        <h3>@lang('csoport.letezo_csoportok')</h3>
        @if(empty($csoportok))
            @lang('csoport.nincsenek_csoportok')
        @else
            <table border="1">
                <tr>
                    <td>@lang('altalanos.nev')</td>
                    <td>@lang('csoport.csoport_hely')</td>
                    <td>@lang('csoport.vezeto') 1</td>
                    <td>@lang('csoport.vezeto') 2</td>
                    @if(userCan("groups.manage", true))
                        <td>@lang('altalanos.szerkesztes')</td>
                    @endif
                </tr>
                @foreach($csoportok as $csoport)
                    <tr>
                        <td>{{$csoport->nev}}</td>
                        <td>{{$csoport->hely}}</td>
                        <td>{{$csoport->vezeto1  ? $csoport->vezeto1->getTeljesNev() : ""}}</td>
                        <td>{{$csoport->vezeto2  ? $csoport->vezeto2->getTeljesNev() : ""}}</td>
                        @if(userCan("groups.manage", true))
                            <td>
                                szerklink
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endif
    @endif

@endsection