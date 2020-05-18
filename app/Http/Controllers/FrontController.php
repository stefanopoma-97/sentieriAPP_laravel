<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
   public function getHome() {
        
        session_start(); //fa partire la sessione e rimanda alla view index
        $dl = new DataLayer();
        
        if(isset($_SESSION['logged'])) {
            $user_id = $dl->getUserID($_SESSION['loggedName']);
            $sentieri_recenti = $dl->getRecent();
            $sentieri_piu_votati = $dl->getPiuVotati();
            $sentieri_consigliati = $dl->getConsigliati($user_id);
            $sentieri_preferiti = $dl->getPreferiti($user_id);
            return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])
                    ->with('user_id', $user_id)->with('sentieri_recenti', $sentieri_recenti)
                    ->with('sentieri_piu_votati', $sentieri_piu_votati)
                    ->with('sentieri_consigliati', $sentieri_consigliati)
                    ->with('sentieri_preferiti', $sentieri_preferiti);
        } else {
            $sentieri_recenti = $dl->getRecent();
            $sentieri_piu_votati = $dl->getPiuVotati();
            return view('index')->with('logged',false)->with('sentieri_recenti', $sentieri_recenti)
                    ->with('sentieri_piu_votati', $sentieri_piu_votati);
        }
    }
}
