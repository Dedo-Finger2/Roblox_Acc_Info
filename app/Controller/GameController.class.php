<?php

namespace App\Controller;

use Exception;

class GameController
{

    /**
     * Cria um formulário para criação de um novo jogo
     */
    public function createForm()
    {

    }

    /**
     * Processa os dados na adição de um novo jogo
     * @param array $data - Dados para criação de um novo jogo
     * @return  int - ID do novo game criado 
     */
    public function storeData($data)
    {

    }

    /**
     * Cria um formulário para edição de um jogo
     * @param int $game_id - ID do jogo que vai ser editado
     */
    public function editForm($game_id)
    {

    }

    /**
     * Processa os dados na edição de um jogo
     * @param array $dados - Novos dados que vão substituir os antigos dados do game
     * @param int $game_id - ID do jogo que vai ser editado
     */
    public function updateData($game_id, $dados)
    {

    }

    /**
     * Abre um modal para confirmar deleção do game
     * @param int $game_id - ID do jogo que vai ser deletado
     */
    public function deleteForm()
    {

    }

    /**
     * Remove um jogo do banco de dados
     * @param int $game_id
     */
    public function deleteData($game_id)
    {

    }
}
