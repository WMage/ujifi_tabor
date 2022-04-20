<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 19:59
 */

use \App\Service\Template;

?>
@extends('layouts.app')

@section('content')
    <h3>Új csoport létrehozása</h3>
    <form method="post">
        <table border="1">
            <tr>

            </tr>
        </table>
    </form>
    <h3>Eddigi csoportok</h3>
    <table border="1">
        <tr>
            <td>Név</td>
            <td>Találkozási pont</td>
            <td>Vezető 1</td>
            <td>Vezető 2</td>
            <td>Vezető 3</td>
            <td>Művelet</td>
        </tr>
    </table>


@endsection