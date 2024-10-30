<?php

namespace App\Session;

class User{

    /**
     * MÉTODO RESPONSÁVEL POR INICIAR A SESSÃO DENTRO DA APLICAÇÃO
     * @return boolean
     */
    private static function init(){
        return session_status() !== PHP_SESSION_ACTIVE ? session_start() : true;
    }

    /**
     * MÉTODO RESPONSÁVEL POR DEFINIR A SESSÃO DE LOGIN DO USUÁRIO 
     * @param string $name
     * @param string $email
     */
    public static function login($name, $email){
        //INICIA A SESSÃO DO USUÁRIO 
        self::init();

        //DEFINE A SESSÃO DO USUÁRIO
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email
        ];
    }
    /**
     * MÉTODO RESPONSÁVEL POR VERIFICAR SE O USUÁRIO ESTÁ LOGADO
     * @return boolean
     */
    public static function Logado(){
        //INICIA A SESSÃO DO USUÁRIO 
        self::init();

        //RETORNA A EXISTENCIA DO ÍNDICE USER NA SESSÃO
        return isset($_SESSION['user']);
    }
    /**
     * MÉTODO RESPONSÁVEL POR RETORNAR AS INFORMAÇÕES GUARDADAS NA SESSÃO DO USUÁRIO
     * @return array
     */
    public static function getInfo(){
        //INICIA A SESSÃO DO USUÁRIO 
        self::init();

        return $_SESSION['user'] ?? [];
    }

    /*
    * DESLOGAR USUÁRIOS
    */
    public static function logout(){
        //INICIA A SESSÃO DO USUÁRIO 
        self::init();

        unset($_SESSION['user']);
    }
}