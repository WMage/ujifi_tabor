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
    <h2><a href="<?=app('request')->url()?>">@lang('csoport.csoport_kezeles')</a></h2>
    @if(userCan("megtekint.csoportok", false))
        @if(userCan("groups.manage"))
        {{--@if(userCan("szerkeszt.csoportok"))--}}
            <h3>@lang('csoport.uj_csoport')</h3>
            <form method="post" action="">
                @csrf
                <table border="1">
                    <tr>
                        <td>@lang('altalanos.nev')</td>
                        <td>
                            <input required name="nev" title="csoport_nev" value="{{oldV('nev')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.csoport_hely')</td>
                        <td>
                            <input name="hely" title="csoport_hely" value="{{oldV('hely')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.vezeto') 1</td>
                        <td>
                            <?= Template::generateSelect(
                                "ID_vezeto1",
                                $csopvez,
                                oldV('ID_vezeto1'),
                                ["ID", "getTeljesNev"]
                            )?>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('csoport.vezeto') 2</td>
                        <td>
                            <?= Template::generateSelect(
                                "ID_vezeto2",
                                $csopvez,
                                oldV('ID_vezeto2'),
                                ["ID", "getTeljesNev"]
                            )?>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="uj_csoport">
            </form>
            <hr>
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
                    <td>@lang('csoport.tagok_szama')</td>
                </tr>
                @foreach($csoportok as $csoport)
                    <tr>
                        <td>
                            @if(userCan("groups.manage"))
                                <a target="_blank" href="{{route("admin.csoport", ["id"=>$csoport->ID])}}">
                                    @endif
                                    {{$csoport->nev}}
                                    @if(userCan("groups.manage"))
                                </a>
                            @endif
                        </td>
                        <td>{{$csoport->hely}}</td>
                        <td>
                            {{$csoport->vezeto1  ? $csoport->vezeto1->getTeljesNev() : ""}}
                        </td>
                        <td>
                            {{$csoport->vezeto2  ? $csoport->vezeto2->getTeljesNev() : ""}}
                        </td>
                        <td>
                            {{$csoport->tagok->count()}}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    @endif

@endsection