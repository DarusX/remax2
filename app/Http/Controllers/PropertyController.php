<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Parser;
use Goutte\Client;
use App\Area;
use Illuminate\Support\Facades\DB;
use App\Equipment;
use App\Detail;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }

    public function sync()
    {

        set_time_limit(0);
        $props = Parser::xml(file_get_contents(env('REMAX_LISTING_URL')));
        Property::query()->delete();
        $count = 0;

        foreach ($props['listing'] as $prop) {
            if($count < 50){
                $property = Property::create([
                    'id' => $prop['home_listing_id'],
                    'availability' => $prop['availability'],
                    'description' => str_replace('m2', 'm²', $prop['description']),
                    'name' => str_replace('m2', 'm2', $prop['name']),
                    'lat' => $prop['latitude'],
                    'lng' => $prop['longitude'],
                    'neighborhood' => $prop['neighborhood'],
                    'price' => substr($prop['price'], 0, -4),
                    'currency' => substr($prop['price'], -3),
                    'address' => 'address',
                    'type' => $prop['property_type']
                ]);
                if(is_array($prop['image']['url'])){
                    foreach ($prop['image']['url'] as $photo) {
                        Property::find($prop['home_listing_id'])->photos()->create([
                            'photo' => $photo
                        ]);
                    }
                } else {
                    Property::find($prop['home_listing_id'])->photos()->create([
                        'photo' => $prop['image']['url']
                    ]);
                }

                $client = new Client();
                $crawler = $client->request('GET', "https://www.remax.com.mx/propiedad/{$prop['home_listing_id']}");
                $crawler->filter('#areas > div > div > span')->each(function($a) use($prop){
                    $area = Area::firstOrCreate(['area' => $a->html()]);
                    Property::find($prop['home_listing_id'])->areas()->attach($area->id);
                });

                $crawler->filter('#equipos > div > div > span')->each(function($e) use($prop){
                    $equipment = Equipment::firstOrCreate(['equipment' => $e->html()]);
                    Property::find($prop['home_listing_id'])->equipments()->attach($equipment->id);
                });
                
                $crawler->filter('#detalles > div')->each(function($d) use($prop){
                    $detail = Detail::firstOrCreate(['detail' => $d->filter('span')->first()->html()]);

                    Property::find($prop['home_listing_id'])->details()->attach($detail->id, ['value' => $d->filter('div > div')->first()->html()]);
                });
                $count++;
            }
        }
    }
}
