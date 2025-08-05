<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $filmes = Filme::when($search, function ($query, $search) {
            return $query->where('titulo', 'like', "%{$search}%")
                ->orWhere('descricao', 'like', "%{$search}%")
                ->orWhere('diretor', 'like', "%{$search}%")
                ->orWhere('genero', 'like', "%{$search}%");
        })->get();

        return view('movies', compact('filmes', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'diretor' => 'required|string',
            'genero' => 'required|string',
            'ano' => 'required|integer',
            'duracao' => 'required|string',
            'nota' => 'required|numeric|min:0|max:10',
        ]);

        Filme::create($request->all());

        return redirect()->route('filmes.index');
    }

    public function edit(Filme $filme)
    {
        return view('edit_movie', compact('filme'));
    }

    public function update(Request $request, Filme $filme)
    {
        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'diretor' => 'required|string',
            'genero' => 'required|string',
            'ano' => 'required|integer',
            'duracao' => 'required|string',
            'nota' => 'required|numeric|min:0|max:10',
        ]);

        $filme->update($request->all());

        return redirect()->route('filmes.index');
    }

    public function destroy(Filme $filme)
    {
        $filme->delete();

        return redirect()->route('filmes.index');
    }
}
