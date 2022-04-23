<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 19:59
 */

/** @var \Illuminate\Support\Collection|\App\Models\Jelentkezo[] $tagok */


use \App\Service\Template;

?>
@extends('layouts.app')

@section('content')
    @if(userCan("groups.manage"))
        @includeWhen(userCan("groups.manage", true), 'tabor.admin.szerkeszt', [
            "module"=>$module,
            "cim"=>$cim,
            "action"=>$action,
            "mezok"=>$mezok,
        ])
        <hr>
        @if(userCan("groups.manage", true))
            <h3>@lang('csoport.tagok_hozzaadasa')</h3>
            <form method="post" action="">
                @csrf
                <input type="hidden" name="action" value="tag_hozzaad">
                <table>
                    @for($i=0;$i<5;$i++)
                        <tr>
                            <td>
                                @php
                                    echo App\Service\Template::generateSelect(
                                    "uj_tag[]",
                                    $csopNelkuliJelentkezok,
                                    null,
                                    ["ID", "getTeljesNev"]
                                )
                                @endphp
                            </td>
                        </tr>
                    @endfor
                    <tr></tr>
                </table>
                <input type="submit">
            </form>
            <hr>
        @endif
        <h3>@lang('csoport.tagok')</h3>
        @foreach($tagok as $tag)
            <div class="row">
                <div class="col-2">
                    <a href="{{$tag->ID}}">{{$tag->getTeljesNev()}}</a>
                </div>
                <form method="post">
                    @csrf
                    <input type="hidden" name="action" value="tag_torol">
                    <input type="hidden" name="tag_ID" value="{{$tag->ID}}">
                    <input type="submit" class="btn btn-danger" value="@lang('altalanos.torles')">
                </form>
            </div>
        @endforeach
    @endif
@endsection