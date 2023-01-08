<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cliente;

class ClienteController extends BaseController
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $data = [
            'clientes' => $this->clienteModel->orderBy('nome', 'asc')->findAll()
        ];
        $data['msg']    = $this->session->getFlashdata('msg');
        $data['estilo'] = $this->session->getFlashdata('estilo');

        return view('cliente/listagem', $data);
    }

    public function inserir()
    {
        $data['acao'] = 'Inserir';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => $this->request->getPost('nome'),
                'nascimento' => $this->request->getPost('nascimento'),
            ];

            if ($this->clienteModel->insert($data, false)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Cliente cadastrado!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível cadastrar o cliente!');
            }
            return redirect()->to(base_url('/clientes'));
        }

        return view('cliente/inserir', $data);
    }

    public function editar($id)
    {
        $cli = $this->clienteModel->find($id);
        $data['cliente'] = $cli;
        $data['acao'] = 'Gravar alteração';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cli->nome = $this->request->getPost('nome');
            $cli->nascimento = $this->request->getPost('nascimento');

            if ($this->clienteModel->update($this->request->getPost('id'), $cli)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Cliente atualizado!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível atualizar os dados do cliente!');
            }
            return redirect()->to('/clientes');
        }

        return view('cliente/inserir', $data);
    }

    public function excluir($id)
    {
        $cli = $this->clienteModel->find($id);
        $data['categoria'] = $cli;
        $data['acao']      = 'Excluir';
        $data['titulo']    = 'Exclusão de cliente';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (is_null($id)) {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Cliente não encontrada!');
                return redirect()->to(base_url('/clientes'));
            }

            if ($this->clienteModel->delete($id, true)) {
                $this->session->setFlashdata('estilo', 'alert-success');
                $this->session->setFlashdata('msg', 'Cliente excluído com sucesso!');
            } else {
                $this->session->setFlashdata('estilo', 'alert-warning');
                $this->session->setFlashdata('msg', 'Não foi possível excluir o cliente!');
            }

            return redirect()->to(base_url('/clientes'));
        }
        return view('cliente/excluir', $data);
    }
}
