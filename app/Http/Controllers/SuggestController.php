<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestRequest;
use App\Models\Suggest;
use App\Models\SuggestCategory;
use App\Rules\GRecaptchaRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

        $request->validate([
            'title' => 'required|min:2|max:40',
            'content' => 'required|min:10',
            'g-recaptcha-response' => [
                'required', new GRecaptchaRule
            ]
            ],
            [
                'title.required' => 'Informe um título',
                'title.min' => 'O título é muito curto!',
                'title.max' => 'O título é muito longo!',
                'content.min' => 'A sugestão é muito curta!',
                'content.required' => 'Uma sugestão precisa ser escrita!',
                'g-recaptcha-response.required' => 'O captcha falhou!'
            ]);

        DB::beginTransaction();

        $suggest = Suggest::create([

            'title'     => $request->title,
            'content'   => $request->content,
            'author'    => (Auth::user() ? Auth::user()->id : null),
            'slug'      => $this->getSlug($request->title),
            'public'    => $request->public && $request->public == 'on' ? false : true

        ]);

        if (!$suggest->save()) {

            DB::rollback();

            return back(500)
                ->with('erro-save', 'Erro ao salvar!');
        }

        if ( isset($request->categories) && count($request->categories) > 0 ) {

            foreach ($request->categories as $i) {

                $suggest_category = SuggestCategory::create([
                    'suggest_id' => $suggest->id,
                    'category_id' => intval($i)
                ]);

                if (!$suggest_category->save()) DB::rollBack();

            }

        }

        DB::commit();

        return back()
            ->with('success', 'true')
            ->with('suggest', $suggest);

    }

    private function getSlug(string $title)
    {
        $slug = Str::slug($title);

        $suggest = Suggest::where('slug', $slug)->get();

        if (count($suggest) > 0){
            $slug = $slug . '-' . (count($suggest) + 1);
        }

        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suggest  $suggest
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $suggest = Suggest::with('user')
            ->where('id', $id)
            ->first();

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
