<?php

namespace App\Controller;

use Exception;

class AccountController
{
    /**
     * Cria um formulário para criação de uma nova conta
     */
    public function createForm()
    {

    }

    /**
     * Processa os dados na adição de um nova conta
     * @param array $data - Dados para criação de um nova conta
     * @return  int - ID da nova conta criado 
     */
    public function storeData($data)
    {

    }

    /**
     * Cria um formulário para edição de uma conta
     * @param int $account_id - ID da conta que vai ser editado
     */
    public function editForm($account_id)
    {

    }

    /**
     * Processa os dados na edição de uma conta
     * @param array $dados - Novos dados que vão substituir os antigos dados da conta
     * @param int $account_id - ID da conta que vai ser editado
     */
    public function updateData($account_id, $dados)
    {

    }

    /**
     * Abre um modal para confirmar deleção da conta
     * @param int $account_id - ID da conta que vai ser deletado
     */
    public function deleteForm()
    {

    }

    /**
     * Remove uma conta do banco de dados
     * @param int $account_id
     */
    public function deleteData($account_id)
    {

    }
}