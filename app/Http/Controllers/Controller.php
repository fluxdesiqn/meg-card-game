<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function startGame() {
    
        $suit = $this->getRandSuit();
        $val = $this->getRandValue();
        $card = $this->stringifyCardName($suit, $val);

        $data = [
            'suit' => $suit,
            'val' => $val,
            'current_card' => $card,
            'all_cards' => $card,
            'score' => 0,
            'wins' => 0,
            'loses' => 0,
            'msg' => ""
        ];

        return json_encode($data);
        
    }

    public function getCard(Request $request) {

        $data = [
            'suit' => $request->params['suit'],
            'val' => $request->params['val'],
            'current_card' => $this->stringifyCardName($request->params['suit'], $request->params['val']),
            'all_cards' => $request->params['cards'],
            'score' => (int)$request->params['score'],
            'wins' => (int)$request->params['wins'],
            'loses' => (int)$request->params['loses'],
            'msg' => ""
        ];

        $suit = $this->getRandSuit();
        $val = $this->getRandValue();
        $card = $this->stringifyCardName($suit, $val);

        if($request->params['type'] && $request->params['type'] == 'lower') {
            $result = $this->isLower($data['val'], $val);
        } else {
            $result = $this->isHigher($data['val'], $val);
        }

        $data['suit'] = $suit;
        $data['val'] = $val;
        $data['current_card'] = $card;
        $data['all_cards'] .= ',' . $card;

        if($result) {

            if($data['score'] == 4) {
                $data['all_cards'] = explode(',', $data['all_cards']);
                $data['msg'] = "Congrats on winning!";
                $data['score'] = 0;
                $data['wins'] = $data['wins'] + 1;
                $data['won'] = true;
            }
        
            $data['score']++;

        } else {

            $data['all_cards'] = $card;
            $data['score'] = 0;
            $data['loses'] = $data['loses'] + 1;
            $data['msg'] = "You Lost!";

        }

        return json_encode($data);

    }

    private function convertValToInt($val) {
        if(is_numeric($val)) {
            return (int)$val;
        } else {
            if($val == 'jack') {
                return 11;
            } elseif($val == 'queen') {
                return 12;
            } elseif($val == 'king') {
                return 13;
            } else {
                return 14;
            }
        }
    }

    private function isLower($current_val, $new_val) {
        $current_val = $this->convertValToInt($current_val);
        $new_val = $this->convertValToInt($new_val);

        if($current_val > $new_val) {
            return true;
        } else {
            return false;
        }
    }

    private function isHigher($current_val, $new_val) {
        $current_val = $this->convertValToInt($current_val);
        $new_val = $this->convertValToInt($new_val);

        if($current_val < $new_val) {
            return true;
        } else {
            return false;
        }
    }

    private function stringifyCardName($suit, $value) {
        return $value . '_of_' . $suit;
    }

    private function getRandSuit() {

        $rand = random_int(0,3);

        $suits = ['spades', 'clubs', 'diamonds', 'hearts'];

        return $suits[$rand];

    }

    private function getRandValue() {

        $rand = random_int(0,12);

        $value = [2,3,4,5,6,7,8,9,10,'jack', 'queen', 'king', 'ace'];

        return $value[$rand];

    }
}
