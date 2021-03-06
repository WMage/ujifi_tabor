<?php
use \App\Service\Template;
?>
@extends('layouts.app')

@section('content')
    <form method="post">
        <table border="1">
            <tr>
                <td>Tábor kiválasztása:</td>
                <td><?= Template::generateSelect('tabor_id', $tabor_list, $tabor_id, array('ID', 'nev')) ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><input required name="email" type="text" value="{{ old('email') }}" title=""></td>
            </tr>
            <tr>
                <td>Név előtag (pl.: Dr, ifj, mr, ...)</td>
                <td><input name="nev_elotag" type="text" value="{{ old('nev_elotag') }}" title=""></td>
            </tr>
            <tr>
                <td>Vezetéknév</td>
                <td><input required name="nev_vezetek" type="text" value="{{ old('nev_vezetek') }}" title=""></td>
            </tr>
            <tr>
                <td>Keresztnév (összes :D)</td>
                <td><input required name="nev_kereszt" type="text" value="{{ old('nev_kereszt') }}" title=""></td>
            </tr>
            <tr>
                <td>Város</td>
                <td><input required name="varos" type="text" value="{{ old('nev_kereszt') }}" title=""></td>
            </tr>
            <tr>
                <td>Születésnap</td>
                <td><input name="szuletesnap" type="date" value="{{ old('szuletesnap') }}" title=""
                           min="1900.01.01" max="<?= Template::getNOWStr() ?>"></td>
            </tr>
            <tr>
                <td>Közös szállás kulcsszó</td>
                <td><input name="szallas_kulcsszo" type="text" value="{{ old('szallas_kulcsszo') }}" title="">
                </td>
            </tr>

            <?php
            if (!empty($tabor_napok_list)):
            ?>
            <tr>
                <td>Szállás</td>
                <td><?= Template::generateChecbox('tabor_napok_lista', $tabor_napok_list, $selected_tabor_napok_list, array('ID', 'datum')) ?></td>
            </tr>
            <?php
            endif;
            ?>
            <tr>
                <td>Étkezés</td>
                <td><input name="asd" type="text" title=""></td>
            </tr>
            <tr>
                <td>Ételérzékenység/diéta</td>
                <td><?= Template::generateChecbox('dieta_erzekenyseg_lista', $dieta_list, $selected_dieta_list, array('ID', 'megnevezes')) ?>
                    Egyéb(vesszővel tagolt):<input name="dieta_erzekenyseg_lista[]" type="text" title=""></td>
            </tr>
            <tr>
                <td>Szívesen segítek ezekben</td>
                <td><?= Template::generateChecbox('segito_munka_lista', $segito_munka_list, $selected_segito_munka_list, array('ID', 'megnevezes')) ?>
                    Egyéb(vesszővel tagolt):<input name="segito_munka_lista[]" type="text" title=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    {{ $aszf }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input name="send" type="submit" title="Jelentkezés" VALUE="Jelentkezés">
                </td>
            </tr>
        </table>
    </form>
@endsection