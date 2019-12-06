<?php

namespace App\Http\Controllers;
use App\Carro;
use Illuminate\Http\Request;

class CarrosController extends Controller
{
    public function __construct()
    {

    }

    public function listaCarros(Request $request)
    {   
        //valida a única opção obrigatória
        $this->validate($request, [
            'tipo' => 'required',
        ]);

        //monta a url dos filtros
        $filtros = $request->tipo;
        if(!empty($request->marca))
            $filtros .= "/".str_replace(" ","-",$request->marca);
        if(!empty($request->marca) and !empty($request->modelo))
            $filtros .= "/".str_replace(" ","-",$request->modelo);
        if(!empty($request->anoModeloDe) or !empty($request->anoModeloAte))
            $filtros .= "/ano-".$request->anoModeloDe."-".$request->anoModeloAte;
        if(!empty($request->precoMin) or !empty($request->precoMax))
            $filtros .= "/preco-".$request->precoMin."-".$request->precoMax;
        if(!empty($request->kmMin) or !empty($request->kmMax))
            $filtros .= "/km-".$request->kmMin."-".$request->kmMax;
        if(!empty($request->origem))
            $filtros .= "/origem-".$request->origem;
        if(!empty($request->estado))
            $filtros .= "/estado-".$request->estado;
        if(!empty($request->financiamento))
            $filtros .= "/financiamento-".$request->financiamento;
        if(!empty($request->troca))
            $filtros .= "/troca-".$request->troca;
        if(!empty($request->cidade))
            $filtros .= "/cidade[]-".$request->cidade; //não sei os valores
        if(!empty($request->versao))
            $filtros .= "/versao-".str_replace(" ","-",$request->versao);
        if(!empty($request->listaAcessorios)){
            $filtros .= "/listaAcessorios[]";
            foreach($request->listaAcessorios as $item){
                $filtros .= "-".$item;
            }
        }
        if(!empty($request->motor))
            $filtros .= "/motor-".$request->motor;
        if(!empty($request->combustivel))
            $filtros .= "/combustivel-".$request->combustivel;
        if(!empty($request->cor))
            $filtros .= "/cor-".str_replace(" ","-",$request->cor);
        if(!empty($request->portas))
            $filtros .= "/portas-".$request->portas;
        if(!empty($request->pagina))
            $filtros .= "?page=".$request->pagina;

        $model = new Carro;
        $response = $model->listaCarros($filtros);

        return $response;
    }

    public function detalhesVeiculo($id){
        $model = new Carro;
        $response = $model->listaCarros($id);

        return $response;
    }
}