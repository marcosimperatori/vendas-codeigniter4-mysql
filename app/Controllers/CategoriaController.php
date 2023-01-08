<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categoria;

class CategoriaController extends BaseController
{
    private $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
    }

    public function index()
    {
        $data = [
            'categorias' => $this->categoria->orderBy('nomecategoria', 'asc')->findAll()
        ];
        $data['msg']    = $this->session->getFlashdata('msg');
        $data['estilo'] = $this->session->getFlashdata('estilo');
        return view('categoria/listagem', $data);
    }

    public function inserir()
    {
        $data['acao'] = 'Inserir';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nomecategoria' => $this->request->getPost('nomecategoria'),
            ];

            if ($this->categoria->insert($data, false)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Categoria inserida!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível inserir a categoria!');
            }
            return redirect()->to('/categorias');
        }

        return view('categoria/inserir', $data);
    }

    public function editar($id)
    {
        $cat = $this->categoria->find($id);
        $data['categoria'] = $cat;
        $data['acao'] = 'Gravar alteração';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cat->nomecategoria = $this->request->getPost('nomecategoria');

            if ($this->categoria->update($this->request->getPost('id'), $cat)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Categoria atualizada!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível atualizar a categoria!');
            }
            return redirect()->to('/categorias');
        }

        return view('categoria/inserir', $data);
    }

    public function excluir($id)
    {
        $cat = $this->categoria->find($id);
        $data['categoria'] = $cat;
        $data['acao']      = 'Excluir';
        $data['titulo']    = 'Exclusão de categoria';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (is_null($id)) {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Categoria não encontrada!');
                return redirect()->to(base_url('/categorias'));
            }

            if ($this->categoria->delete($id, true)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Categoria excluída com sucesso!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível excluir a categoria!');
            }

            return redirect()->to(base_url('/categorias'));
        }
        return view('categoria/excluir', $data);
    }
}
