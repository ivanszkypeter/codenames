<?php

namespace App\Http\Controllers;

use App\Events\RoomUpdate;
use App\Models\Room;
use App\Models\Word;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;

class GameController extends Controller
{
    private $numberOfFields = [
        'red'     => 8,
        'blue'    => 8,
        'netural' => 7,
        'death'   => 1,
    ];

    private $nextPlayer = [
        'red'  => 'blue',
        'blue' => 'red',
    ];

    public function getRoomState($id = null)
    {
        try {
            $state = Room::whereId($id)->firstOrFail()->state;
        } catch (ModelNotFoundException $exception) {
            $state = $this->createRoom($id);
        }

        return $this->calcFieldPosition($state);
    }

    private function createRoom($id)
    {
        $state = [];
        $state['currentTeam'] = $this->randCurrentTeam();
        $wordList = $this->shuffleRandomWords();
        $typeList = $this->randFieldColors($state['currentTeam']);

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $state['table'][$i][$j]['word'] = $wordList[$i * 5 + $j]['word'];
                $state['table'][$i][$j]['type'] = $typeList[$i * 5 + $j];
                $state['table'][$i][$j]['flipped'] = false;
            }
        }
        $state['score'] = [
            'red'  => 0,
            'blue' => 0,
        ];
        $state['nextButton'] = 'Start';
        $state['state'] = 'start';
        $this->saveRoom($id, $state);

        return $state;
    }

    public function flip($id, $x, $y)
    {
        $room = Room::whereId($id)->firstOrFail();
        $state = $room->state;
        if ($state['state'] == 'start') {
            $state['table'][$x][$y]['word'] = '';
            $state['table'][$x][$y]['word'] = $this->newWord($state);
        }
        if ($state['state'] == 'game') {
            $field = $state['table'][$x][$y];
            $field['flipped'] = true;
            switch ($field['type']) {
                case 'death':
                    if ($state['currentTeam'] === 'red') {
                        $state['score']['red'] = 0;
                    }
                    if ($state['currentTeam'] === 'blue') {
                        $state['score']['blue'] = 0;
                    }
                    $state['state'] = 'end';
                    $state['nextButton'] = 'Restart';
                    break;
                case 'netural':
                    $this->nextPlayer($state);
                    break;
                default:
                    $team = $field['type'];
                    $state['score'][$team]++;
                    if ($state['currentTeam'] != $team) {
                        $this->nextPlayer($state);
                    }
                    break;
            }
        }
        $room->state = $state;
        $room->save();
        $this->broadcast($room->id, $state);
    }

    public function turn($id = null)
    {
        $room = Room::whereId($id)->firstOrFail();
        $state = $room->state;
        switch ($state['state']) {
            case 'start':
                $state['nextButton'] = 'Next';
                $state['state'] = 'game';
                $room->state = $state;
                $room->save();
                break;
            case 'game':
                $this->nextPlayer($state);
                $room->state = $state;
                $room->save();
                break;
            default:
                $room->delete();
                $state = $this->createRoom($room->id);
                break;
        }
        $this->broadcast($id, $state);
    }

    private function nextPlayer(&$state)
    {
        $state['currentTeam'] = $this->nextPlayer[$state['currentTeam']];
    }

    /**
     * @param string $startTeam
     */
    private function randFieldColors($startTeam)
    {
        $this->numberOfFields[$startTeam] += 1;

        $typeList = [];
        foreach ($this->numberOfFields as $color => $number) {
            for ($i = 0; $i < $number; $i++) {
                $typeList[] = $color;
            }
        }
        shuffle($typeList);

        return $typeList;
    }

    private function newWord(&$state)
    {
        $newWord = Word::inRandomOrder()->first()->word;
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                if ($newWord == $state['table'][$i][$j]['word']) {
                    $newWord = $this->newWord($state);
                    break 2;
                }
            }
        }

        return $newWord;
    }

    private function calcFieldPosition($state)
    {
        $x = 0;
        $y = 0;
        foreach ($state['table'] as &$rows) {
            foreach ($rows as &$cell) {
                $cell['x'] = $x;
                $cell['y'] = $y;
                $x++;
            }
            $x = 0;
            $y++;
        }

        return $state;
    }

    private function broadcast($roomId, $state)
    {
        event(new RoomUpdate($roomId, $this->calcFieldPosition($state)));
    }

    private function randCurrentTeam()
    {
        return rand(0, 1) == 0 ? 'red' : 'blue';
    }

    private function saveRoom($id, $state)
    {
        $room = new Room();
        $room->id = $id;
        $room->state = $state;
        $room->save();
    }

    private function shuffleRandomWords()
    {
        $wordList = Word::inRandomOrder()->take(25)->get()->toArray();
        shuffle($wordList);

        return $wordList;
    }
}
