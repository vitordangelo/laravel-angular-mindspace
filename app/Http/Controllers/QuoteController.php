<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::all();

        if(!$quotes) 
        {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json([ 'status' => 'Success', 'data' => $quotes], 200);
    }

    public function store(Request $request)
    {
        // $quote = Quote::create($request->all());
        $quote = new Quote();
        $quote->content = $request->input('content');
        $quote->save();

        if(!$quote->content) 
        {
            return response()->json(['error' => 'Não pode ser vazio'], 404);
        }

        return response()->json([ 'status' => 200, 'data' => $quote], 200);
    }

    public function show(Quote $quote)
    {
        $quote = Quote::find($id);

        if (!$quote)
        {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json([ 'status' => 200, 'data' => $quote], 200);
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);

        if (!$quote) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $quote->update($request->all());

        return response()->json([ 'status' => 200, 'data' => $quote], 200);
    }

    public function destroy(Request $request, $id)
    {
        $quote = Quote::destroy($id);

        if (!$quote) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json([ 'status' => 200, 'data' => $quote], 200);
    }
}
