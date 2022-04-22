<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 19:59
 */

/** @var string $module */
/** @var string $cim */
/** @var string $action */

/** @var string[]|string[][][] $mezok */

?>
@extends('layouts.app')

@section('content')
    @if(userCan("groups.view"))
        <h2>{{$module}} @lang('altalanos.szerkesztes')</h2>
        <h3>@lang($cim)</h3>
        <form method="post" action="{{$action}}">
        @csrf <!-- {{ csrf_field() }} -->
            <table border="1">
                @foreach($mezok as $nev=>$mezo)
                    <tr>
                        <td>{{$mezo["cim"]}}</td>
                        <td>
                            @if(isset($mezo["ertekek"]))
                                @php
                                    echo App\Service\Template::generateSelect(
                                    $nev,
                                    $mezo["ertekek"],
                                    oldV($nev, $mezo["ertek"]),
                                    $mezo["kulcsok"]??["ID", "nev"]
                                )
                                @endphp
                            @else
                                <input name="{{$nev}}" title="{{$nev}}" value="{{oldV($nev, $mezo["ertek"])}}"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <input type="submit"/>
        </form>
    @endif
@endsection