<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use App\Estado;
use App\Municipio;

class FilterSelectController extends Controller
{
    public function estados(Pais $pais)
    {
        return json_encode($pais->estados);
    }
    public function municipios(Estado $estado)
    {
        return json_encode($estado->municipios);
    }
    public function municipioGetEstado(Municipio $municipio)
    {
        return json_encode(['estado'=> $municipio->estado,'municipios'=>$municipio->estado->municipios]);
    }
    public function estadoGetPais(Estado $estado)
    {
        return json_encode(['pais'=>$estado->pais,'estados'=>$estado->pais->estados]);
    }
}
