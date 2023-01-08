<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categoria;
use App\Models\Produto;

class ProdutoController extends BaseController
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    public function index()
    {
        $data = [
            'produtos' => $this->produtoModel->orderBy('descproduto', 'asc')->findAll()
        ];
        $data['msg']    = $this->session->getFlashdata('msg');
        $data['estilo'] = $this->session->getFlashdata('estilo');

        return view('produto/listagem', $data);
    }

    public function inserir()
    {
        $data['acao'] = 'Inserir';

        /*   helper('form');
        $categoriaModel = new Categoria();
        $lista = $categoriaModel->findAll();
        $categorias = [];

        foreach ($lista as $item) {
            $categorias[$item->id] = $item->nomecategoria;
        }*/

        // $data['idcategoria'] = form_dropdown('idcategoria', $categorias);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->produtoModel->insert($this->request->getPost(), false)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Produto inserido!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível cadastrar o produto!');
            }
            return redirect()->to(base_url('/produtos'));
        }

        $categoria = new Categoria();
        $data['categorias'] = $categoria->orderBy('nomecategoria', 'asc')->findAll();

        return view('produto/inserir', $data);
    }

    public function editar($id)
    {
        $prod = $this->produtoModel->find($id);
        $data['produto'] = $prod;
        $data['acao'] = 'Gravar alteração';

        helper('form');
        $categoriaModel = new Categoria();
        $lista = $categoriaModel->findAll();
        $categorias = [];

        foreach ($lista as $item) {
            $categorias[$item->id] = $item->nomecategoria;
        }

        $data['idcategoria'] = form_dropdown('idcategoria', $categorias);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prod->desproduto  = $this->request->getPost('descproduto');
            $prod->idcategoria = $this->request->getPost('idcategoria');
            $prod->preco       = $this->request->getPost('preco');

            if ($this->produtoModel->update($this->request->getPost('id'), $this->request->getPost())) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Produto atualizado!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível atualizar o produto!');
            }
            return redirect()->to('/produtos');
        }

        $categoria = new Categoria();
        $data['categorias'] = $categoria->orderBy('nomecategoria', 'asc')->findAll();
        return view('produto/inserir', $data);
    }

    public function excluir($id)
    {
        $prod = $this->produtoModel->find($id);
        $data['categoria'] = $prod;
        $data['acao']      = 'Excluir';
        $data['titulo']    = 'Exclusão de categoria';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (is_null($id)) {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Produto não encontrado!');
                return redirect()->to(base_url('/produtos'));
            }

            if ($this->produtoModel->delete($id, true)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Produto excluído com sucesso!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível excluir o produto!');
            }

            return redirect()->to(base_url('/produtos'));
        }
        return view('produto/excluir', $data);
    }
}
