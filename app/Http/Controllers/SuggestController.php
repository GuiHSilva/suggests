<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestRequest;
use App\Models\Suggest;
use App\Rules\GRecaptchaRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $suggests = Suggest::with('categories')->paginate();

        return view('admin.suggest.index', [
            'suggests' => $suggests
        ]);
    }

    public function suggestMarkread(int $id){

        $suggest = Suggest::find($id);

        if (!$suggest)
        {
            return response()->json(['error' => true, 'msg' => 'Sugestão não encontrada'], 404);
        }

        $suggest->viewed = $suggest->viewed ? false : true;

        if (!$suggest->save()){
            return response()->json(['error' => true, 'msg' => 'Sugestão não pode ser salva'], 500);
        }

        return response()->json(['error' => false, 'msg' => 'Sugestão salva!', 's' => $suggest], 200);
    }

    public function like(int $id){

        $suggest = Suggest::findOrFail($id);

        $likes = Session::get('likes');

        return response()->json([
            'likes' => $suggest->likes
        ]);

    }

    public function suggestPagination(){

        $suggests = Suggest::with('categories')->paginate();

        return view('admin.suggest.table', [
            'suggests' => $suggests
        ])->render();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'title' => 'required|min:2|max:191',
            'content' => 'required|min:10',
            'g-recaptcha-response' => [
                'required', new GRecaptchaRule
            ]],
            [
                'title' => 'Informe um título',
                'content.min' => 'A sugestão é muito curta {{min}}!',
                'content.required' => 'Uma sugestão precisa ser escrita!',
                'g-recaptcha-response.required' => 'O captcha falhou!'
            ]);

        if ($validate->fails()) {
            return back()
                ->with('error', $validate->errors());
        }

        $suggest = Suggest::create($request->all());

        $suggest->save();

        return response()->json($suggest);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suggest  $suggest
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $suggest = Suggest::with('user')->where('id', $id)->first();

        if (!$suggest) {
            return view('admin/error/404');
        }

        return view('admin/suggest/show', [
            'suggest'   =>  $suggest,
            'user'      =>  $suggest->user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suggest  $suggest
     * @return \Illuminate\Http\Response
     */
    public function edit(Suggest $suggest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suggest  $suggest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggest $suggest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggest  $suggest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suggest $suggest)
    {
        //
    }
}
