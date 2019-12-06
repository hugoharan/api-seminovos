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
            return response()->json('{"Nenhum resultado encontrado."}', 200);
        }
    }
}
