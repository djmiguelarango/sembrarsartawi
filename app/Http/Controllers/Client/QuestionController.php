<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class QuestionController extends Controller
{
    private $retailerProduct;

    public function __construct()
    {
        $this->retailerProduct = new RetailerProductController(new RetailerProductRepository);
        $this->client          = new ClientController(new ClientRepository);
    }

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
     * @param String $rp_id
     * @param String $header_id
     * @param String $client_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $client_id)
    {
        $client = null;

        if ($this->client->clientById(decode($client_id))) {
            $client = $this->client->getClient();
        }

        $data = [
            'client'    => $client,
            'questions' => $this->retailerProduct->questionByProduct($rp_id)
        ];

        return view('client.de.question', compact('rp_id', 'header_id', 'client_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
