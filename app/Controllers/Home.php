<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class Home extends BaseController
{
    public function index()
    {
        $categorias = new Categoria();
        $produtos = new Produto();
        $clientes = new Cliente();
        $vendas   = new Venda();

        $dashboard = [
            'categoria' => $categorias->countAllResults(),
            'produto'   => $produtos->countAllResults(),
            'cliente'   => $clientes->countAllResults(),
            'venda'     => $vendas->countAllResults(),
            'grafico'   => $this->vendasPorDia(),
        ];

        return view('welcome_message', $dashboard);
    }

    private function vendasPorDia()
    {
        $vendas = new Venda();
        $dados = $vendas->select('datacompra,qtde')->groupBy('datacompra')->selectCount('id')->orderBy('datacompra', 'asc')->findAll();

        $dados1 = $vendas->select('(date_format(datacompra,"%d/%m/%Y")) as data, id')->selectSum('qtde', 'total')->groupBy('datacompra')->orderBy('datacompra', 'asc')->findAll();

        foreach ($dados as $dado) {
            $result[] = [
                $dado->datacompra,
                $dado->qtde
            ];
        }

        return $dados1;
        //return json_encode($result);
    }
}
