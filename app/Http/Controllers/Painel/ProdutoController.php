<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;

class ProdutoController extends Controller
{
    private $product;
    private $qtdItensPorPagina = 5;
    public function __construct(Product $product) 
    {
        $this->product = $product;
    }

    public function index(Product $product)
    {
        $title = 'Listagem dos Produtos';
        
        $products = $product->paginate($this->qtdItensPorPagina);
        return view('painel.products.index', compact('products', 'title'));
    }
    
    public function create()
    {
        $title = 'Cadastrar novo produto';
        $categories = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.products.create-edit', compact('title', 'categories'));
    }
    
    public function store(ProductFormRequest $request)
    {
        ///dd($request->all()); ///captura todos os campos do meu formulario
        ///dd($request->only(['name','number'])); ///Captura apenas os campos informados(name, number)
        ///dd($request->except(['_token']));///Captura todos os campos, exceto o campo informado (token)
        ///dd($request->input('name'));///Captura apenas o valor do campo informado
        ///dd($request->checkbox );
        
        $dataForm = $request->all();
        
        $dataForm['active'] = ( !isset($dataForm['active'])) ? 0 : 1; ///Verifica se o checkbox esta marcado, se sim atribui 1 senão 0.
        
        /*$validate = Validator::make($dataForm, $this->product->rules);
        
        if($validate->fails())
        {
            return redirect()->route('produtos.create')->withErrors($validate)->withInput(); ///Faz a mesma coisa que a linha abaixo
        }
        ///Validação dos dados
        
        $messages = ['name.required' => 'O campo nome é de preenchimento obrigatorio!', 
                    'number.required' => 'O campo numero é de preenchimento obrigatorio!',
                    'number.numeric' => 'Neste campo é permitido apenas números!'];      
        $this->validate($request, $this->product->rules, $messages);
             */   
        $insert = $this->product->create($dataForm); ///faz o cadastro no banco de dados
        
        if($insert)
            return redirect ()->route('produtos.index'); ///Se o formulario foi preenchido de maneira correta, o usuário é redirecionado a esta rota
        else 
            return redirect ()->back (); ///Caso o ususário tenha preenchido de maneira incorreta ele é redirecionado de volta ao formulario
    }
    
    public function show($id) 
    {
      $product = $this->product->find($id);
      
      $title = "Produto: {$product->name}";
      
      return view('painel.products.show', compact('product', 'title'));
    }
    
    public function edit($id) 
    {
        $product = $this->product->find($id);
        
        $title = "Editar produto: {$product->name}";
        
        $categories = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.products.create-edit', compact('title', 'categories', 'product'));
    }
    
    public function update(ProductFormRequest $request, $id) 
    {
        ///Recupera todos os dados do formulário
        $dataForm = $request->all();
        
        ///Recupera o item para editar
        $product = $this->product->find($id);
        
        ///Verifica se o produto está ativado
        $dataForm['active'] = ( !isset($dataForm['active'])) ? 0 : 1; ///Verifica se o checkbox esta marcado, se sim atribui 1 senão 0.
        
        ///Altera os itens
        $update = $product->update($dataForm);
        
        ///Verifica se realmente editou
        if($update)
            return redirect ()->route ('produtos.index');
        else 
            return redirect()->route('produtos.edit', $id)->with(['errors' => 'Falha ao editar']);
    }
    
    public function destroy($id) 
    {
        $product = $this->product->find($id);
        
        $delete = $product->delete();
        
        if($delete)
            return redirect ()->route ('produtos.index');
        else 
            return redirect()->route('produtos.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
    
    public function oi($id)
    { 
         $prod = $this->product->find($id); ///Procura o id na tabela e deleta o numero, com o parametro where é possivel 
                                         ///encontrar com qualquer elemento fornecido
        $delete = $prod->delete();  ///Tambem pode utilizar o metodo destroy()
        
        if($delete)
        {
            return "Deletado com sucesso";
        }
        
        return "Falha ao deletar";
    }
    
    public function tests($id)
    { 
        /*$prod = $this->product;  
        $prod->name = "Nome do Produto";
        $prod->number = 131231;
        $prod->active = true;
        $prod->category = "eletronicos";                            ///Modelo de inserção manual
        $prod->description = "Description do produto aqui";
        $insert = $prod->save();
        
        if($insert)
        {
            return "Inserido com Sucesso";
        }
            return "Falha ao inserir";*/
        
        /*O metodo insert não é recomendavel de utilização pois o usuário pode alterar a estrutura deste
         codigo e inserir dados para se tornar administrador do sistema
         Em substituição deve se utilizar o comando $create        
        $insert = $this->product->insert(["name"=>"Nome do Produto2", "number"=> 434435, 'active'=>false, "category"=>"Eletronicos", "description"=>"Descrição vem aqui"]);
        */
        /*$insert = $this->product->create(["name"=>"Nome do Produto 2", "number"=> 434435, 'active'=>false, "category"=>"Eletronicos", "description"=>"Descrição vem aqui"]);
        if($insert)
        {
        return "Inserido com SucessoID {$insert->id}";
        }
            return "Falha ao inserir";
        */   
        
        
        /*
        $update = $this->product->find(5)->update(["name" => "Update", "number" => 6765756, "active" => true]);
        ///dd($prod); ///dd= Dump and die, este comando ordena a exibição do conteudo na tela e não lê nenhuma das linhas a baixo. 
        if($update)
        {
            return "Alterado com Sucesso";  ///A função find() procura pelo banco de dados elementos pelo id(Com todos os seus atributos)
        }
            return "Falha ao alterar";
         * 
         */
        
        /*
        $update = $this->product->where("number", 6765756)->update(["name" => "Update test 2", "number" => 67657560, "active" => false]);
        ///dd($prod); ///dd= Dump and die, este comando ordena a exibição do conteudo na tela e não lê nenhuma das linhas a baixo. 
        if($update)
        {
            return "Alterado com Sucesso";  ///A função where procura pelo banco de dados elementos pelo 
                                           ///parametro fornecido pelo usuário(Com todos os seus atributos)
        }
            return "Falha ao alterar";
         */
        
        $prod = $this->product->find($id); ///Procura o id na tabela e deleta o numero, com o parametro where é possivel 
                                         ///encontrar com qualquer elemento fornecido
        $delete = $prod->delete();  ///Tambem pode utilizar o metodo destroy()
        
        if($delete)
        {
            return "Deletado com sucesso";
        }
        
        return "Falha ao deletar";
    }
    
    
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

