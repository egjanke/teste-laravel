<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Client;
use App\Models\Telephone;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::with('categories')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validateState($request);
        if (!$validate['validated']){
            return response($validate['message'], 401);
        }

        $client = new Client();
        $client->fill($request->all());
        $client->saveOrFail();
        return $client;
    }

    public function validateState(Request $request){
        // valida se o usuario é de minas gerais e se é pessoa fisica
        $validator = Validator::make($request->all(),[
            'state' => [function ($attribute, $value, $fail) use ($request){
                if ($value == 'MG' &&  $request->type == 'Física'){
                    $fail('Pessoa física não pode ser cadastrada em MG');
                }
            }],
        ]);

        if ($validator->fails()){

            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'field', 'Something is wrong with this field!'
                );
            });

            return ['validated' => false, 'message' => $validator->errors()];
        }

        return ['validated' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $client = Client::with('categories')->where('id', $id)->get();
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $this->validateState($request);
        if (!$validate['validated']){
            return response($validate['message'], 401);
        }

        $client = Client::findOrFail($id);
        $client->fill($request->all());
        if (!$client->isDirty()){
            return;
        }
        $client->saveOrFail();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client){
            $client->delete();
        }
    }
}
