<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 19:59
 */

/** @var \Illuminate\Support\Collection|\App\Models\Tabor[] $taborok */


?>
@extends('layouts.app')

@section('content')
    <h2><a href="<?=app('request')->url()?>">@lang('tabor.taborok_kezeles')</a></h2>
    @if(userCan("megtekint.taborok", false))
        {{--@if(userCan("szerkeszt.csoportok"))--}}
            <h3>@lang('taborok.uj_tabor')</h3>
            <form method="post" action="">
                @csrf
                <table border="1">
                    <tr>
                        <td>@lang('cim.varos')</td>
                        <td>
                            <input required name="varos" title="tabor_varos" value="{{oldV('varos')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('tabor.motto')</td>
                        <td>
                            <input name="motto" title="tabor_motto" value="{{oldV('motto')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('tabor.kezdete')</td>
                        <td>
                            <input required name="kezdete" type="date" title="tabor_kezdet" value="{{oldV('kezdete')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('tabor.vege')</td>
                        <td>
                            <input required name="vege" type="date" title="tabor_vege" value="{{oldV('vege')}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('tabor.aszf')</td>
                        <td>
                            <textarea required name="aszf" cols="60" rows="6" title="tabor_aszf" >{{oldV('aszf')}}</textarea>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="uj_tabor">
            </form>
            <hr>
        <h3>@lang('tabor.letezo_taborok')</h3>
            <table border="1">
                <tr>
                    <td>@lang('cim.varos')</td>
                    <td>@lang('tabor.motto')</td>
                    <td>@lang('tabor.kezdete')</td>
                    <td>@lang('tabor.vege')</td>
                    <td>@lang('tabor.regisztracio_aktiv')</td>
                </tr>
                @foreach($taborok as $tabor)
                    <tr>
                        {{--<td>--}}
                            {{--@if(userCan("szerkeszt.taborok"))--}}
                                {{--<a target="_blank" href="{{route("admin.csoport", ["id"=>1])}}">--}}
                                    {{--@endif--}}
                                    {{--{{$csoport->nev}}--}}
                                    {{--@if(userCan("groups.manage"))--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        <td>{{$tabor->varos}}</td>
                        <td>{{$tabor->motto}}</td>
                        <td>{{$tabor->kezdete}}</td>
                        <td>{{$tabor->vege}}</td>
                        <td>{{$tabor->regisztracioAktivE()}}</td>
                    </tr>
                @endforeach
            </table>
    @endif

@endsection