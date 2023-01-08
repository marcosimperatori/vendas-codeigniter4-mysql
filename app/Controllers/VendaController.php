<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class VendaController extends BaseController
{
    private $vendaModel;

    public function __construct()
    {
        $this->vendaModel = new Venda();
    }

    public function index()
    {
        $data = [
            'vendas' => $this->vendaModel
                ->select('venda.id,venda.datacompra,venda.valorunitario,c.nome')
                ->join('cliente as c', 'c.id=venda.idcliente')
                ->orderBy('datacompra', 'desc')->findAll(),
        ];
        $data['msg']    = $this->session->getFlashdata('msg');
        $data['estilo'] = $this->session->getFlashdata('estilo');
        return view('venda/listagem', $data);
    }

    public function inserir()
    {
        $data['acao'] = 'Gravar';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->vendaModel->insert($this->request->getPost(), false)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Venda inserida!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível gravar a venda!');
            }
            return redirect()->to(base_url('/vendas'));
        }

        $cliente = new Cliente();
        $data['clientes'] = $cliente->orderBy('nome', 'asc')->findAll();

        $produto = new Produto();
        $data['produtos'] = $produto->orderBy('descproduto', 'asc')->findAll();

        return view('venda/inserir', $data);
    }

    public function editar($id)
    {
        $venda = $this->vendaModel->find($id);
        $data['venda'] = $venda;
        $data['acao'] = 'Gravar alteração';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $venda->idcliente     = $this->request->getPost('idcliente');
            $venda->idproduto     = $this->request->getPost('idproduto');
            $venda->qtde          = $this->request->getPost('qtde');
            $venda->valorunitario = $this->request->getPost('valorunitario');
            $venda->datacompra    = $this->request->getPost('datacompra');

            if ($this->vendaModel->update($this->request->getPost('id'), $venda)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Venda atualizada!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível atualizar a venda!');
            }
            return redirect()->to('/vendas');
        }

        $cliente = new Cliente();
        $data['clientes'] = $cliente->orderBy('nome', 'asc')->findAll();

        $produto = new Produto();
        $data['produtos'] = $produto->orderBy('descproduto', 'asc')->findAll();

        return view('venda/inserir', $data);
    }
}
