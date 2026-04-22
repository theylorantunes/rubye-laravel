<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Se o usuário já tiver forçado uma troca de idioma na loja (via um botão), usamos a sessão
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } 
        // 2. Se não, nós lemos a configuração do navegador dele!
        else {
            // O Laravel lê o cabeçalho 'Accept-Language' do navegador.
            // Passamos um array com os idiomas que a nossa loja suporta: ['pt', 'en']
            $idiomaNavegador = $request->getPreferredLanguage(['pt', 'en']);
            
            App::setLocale($idiomaNavegador);
        }

        return $next($request);
    }
}