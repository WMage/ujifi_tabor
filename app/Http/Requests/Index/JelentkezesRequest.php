<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\BaseRequest;

/**
 * @property-read int $tabor_id
 * @property-read string $email
 * @property-read string $nev_elotag
 * @property-read string $nev_vezetek
 * @property-read string $nev_kereszt
 * @property-read string $varos
 * @property-read string $szuletesnap
 * @property-read string $szallas_kulcsszo
 * @property-read array|int[] $tabor_napok_lista
 * @property-read array|int[] $tabor_etkezes_lista
 * @property-read array|int[] $dieta_erzekenyseg_lista
 * @property-read string $dieta_erzekenyseg_tovabbi
 * @property-read array|int[] $segito_munka_lista
 * @property-read string $segito_munka_tovabbi
 */
class JelentkezesRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'tabor_id' => ['required', 'int'],
            'email' => ['required', 'string'],
            'nev_elotag' => ['string', 'nullable'],
            'nev_vezetek' => ['required', 'string'],
            'nev_kereszt' => ['required', 'string'],
            'varos' => ['required', 'string'],
            'szuletesnap' => ['required', 'string'],
            'szallas_kulcsszo' => ['string', 'nullable'],
            'tabor_napok_lista' => [/*'required', */'array'],
            'tabor_etkezes_lista' => [/*'required',*/ 'array'],
            'dieta_erzekenyseg_lista' => ['required_without:dieta_erzekenyseg_tovabbi', 'array'],
            'dieta_erzekenyseg_tovabbi' => ['required_without:dieta_erzekenyseg_lista', 'string', 'nullable'],
            'segito_munka_lista' => ['required_without:segito_munka_tovabbi', 'array'],
            'segito_munka_tovabbi' => ['required_without:segito_munka_lista', 'string', 'nullable'],
            'aszf' => ['required', 'accepted']
        ];
    }
}
