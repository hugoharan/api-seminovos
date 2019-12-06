<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

class Carro extends Model
{
    public static function listaCarros($url){

        $resultados = file_get_contents("https://seminovos.com.br/".$url);
        //lê o DOM da página desejada
        $crawler = new Crawler($resultados);
        $semResultado = $crawler->filter('.nenhum-reseultado');
        //verifica se houve algum resultado
        if($semResultado->count() == 0){
            //monta o array com os resultados encontrado
            $cars = $crawler->filter('.card')->each(function($item){
                $id = $item->filter('meta')->first()->attr('content');
                $thumb = $item->filter('figure')->children('a > img')->first()->attr('src');
                $content = $item->filter('.card-content');
                $marcaModelo = $content->children('a > .card-title')->text();
                $preco = $content->children('a > div > .card-price')->text();
                $versao = $content->children('.card-info > .card-features > .card-subtitle > span')->text();
                $ano = $content->children('.card-info > .card-features > ul > li')->first()->text();
                $km = $content->children('.card-info > .card-features > ul > li > b')->text();
                $origem = $content->children('.card-info > .card-features > p ')->eq(1)->text();
                $cambio = $content->children('.card-info > .card-features > ul > li')->eq(2)->text();
                $features = $content->children('.card-info > .card-features > ul > li > span')->each(function($feature) {
                    return str_replace(", ", "", $feature->text());
                });

                $response = array(  'id' => $id,
                                    'img' => $thumb,
                                    'marcaModelo' => $marcaModelo,
                                    'preco' => $preco,
                                    'versao' => $versao,
                                    'ano' => $ano,
                                    'km' => $km,
                                    'origem' => $origem,
                                    'cambio' => $cambio,
                                    'listaAcessorios' => $features);

                return $response;
            });

            $page = $crawler->filter('.pagination-container')->children('.info > b')->eq(0)->text();
            $total = $crawler->filter('.pagination-container')->children('.info > b')->eq(1)->text();

            $response['page'] = $page;
            $response['totalPages'] = $total;
            $response['cars'] = $cars;

            return response()->json($response, 200);
        }
        else{
            return response()->json('Nenhum resultado encontrado.', 400);
        }
    }

    public static function detalhesVeiculo($id){
        
        $resultado = @file_get_contents("https://seminovos.com.br/".$id);
        //lê o DOM da página desejada
        $crawler = new Crawler($resultado);

        $marcaModelo = $crawler->filter('.item-info')->children('h1')->text();
        $versao =  $crawler->filter('.item-info')->children('div > p')->text();
        $preco =  $crawler->filter('.item-info')->children('.price')->text();
        $anoModelo = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(0)->text();
        $km = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(1)->text();
        $cambio = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(2)->text();
        $portas = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(3)->text();
        $combustivel = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(4)->text();
        $cor = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(5)->text();
        $placa = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(6)->text();
        $troca = $crawler->filter('.attr-list')->children('dl > dd >span')->eq(7)->text();
        $obs = $crawler->filter('.meta-properties')->children('.description-print')->text();
        $images = $crawler->filter('.gallery-main')
                        ->children('.gallery-thumbs > ul > li > img')
                        ->each(function($feature) {
                            return $feature->attr('src');
                        });
        $listaAcessorios = $crawler->filter('.full-features')
                        ->children('ul > li > span')
                        ->each(function($feature) {
                            return $feature->text();
                        });

          
        $response = array(  'id' => $id,
                            'marcaModelo' => $marcaModelo,
                            'preco' => $preco,
                            'versao' => $versao,
                            'ano' => $anoModelo,
                            'km' => $km,
                            'cambio' => $cambio,
                            'cor' => $cor,
                            'placa' => $placa,
                            'troca' => $troca,
                            'obs' => $obs,
                            'img' => $images,
                            'listaAcessorios' => $listaAcessorios
                            );

        return $response;
    }
}
