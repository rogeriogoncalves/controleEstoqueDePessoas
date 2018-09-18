<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct() {
        ///$this->middleware('auth')->only(['contato', 'categoria']);//necessário estar logado para acessar contato e categoria
        ///$this->middleware('auth')->except(['index', 'contato']); //necessário estar logado para acessar todas as paginas, exceto index e contato
    }

    public function index()
    {
        $title = 'Titulo teste';
        
        $xss = '<script>alert("Ataque XSS");</script>)';
        
        $var1 = 123;
        
        $arrayData = [1,2,3,4,5,6,7,8,9];
        
        return view('site.home.index', compact('title', 'xss', 'var1', 'arrayData')); 
    }
    
    public function contato()
    {
        return view('site.contact.index');
    }
    
    public function destroy($id)
    {
        return view('painel.products.destroy');
    }
    
    public function categoria($id)
    {
        return "Listagem dos posts da categoria: {$id}";
    }
    
    public function categoriaOp($id = 1)
    {
        return "Listagem dos posts da categoria: {$id}";
    }
    
    
    
    
}

