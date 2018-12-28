<?php

/**
 * Description of cls
 *
 * @author assparremberger
 */

namespace App\Model;

class Conexao {

    private function abrir() {
        $local = "localhost";
        $banco = "geradorxml";
        $usuario = "root";
        $senha = "";
        $link = mysqli_connect($local, $usuario, $senha, $banco);
        if ($link)
            return $link;
        else
            return FALSE;
    }

    private function fechar($link) {
        mysqli_close($link);
    }

    public function consultar($query) {
        $link = $this->abrir();
        if ($link) {
            $result = mysqli_query($link, $query);
            $this->fechar($link);
            return $result;
        } else {
            return FALSE;
        }
    }

    public function executar($query) {
        $link = $this->abrir();
        if ($link) {
            mysqli_query($link, $query);
            $this->fechar($link);
        }
    }

}
