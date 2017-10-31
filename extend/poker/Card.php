<?php

namespace poker;


class Card
{
    protected $rank, $suit;

    public function __construct($rank, $suit)
    {
        if(!in_array(trim($rank), ['1','2','3','4','5','6','7','8','9','T', 'J','Q', 'K', 'A']) || !in_array(strtolower(trim($suit)), ['spade', 'heart', 'club','diamond'])){
            exit('Wrong cards!');
        }
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @return mixed
     */
    public function getSuit()
    {
        return $this->suit;
    }

    public function getRankNum($highA = 1)
    {
        $rank = $this->getRank();
        switch ($rank) {
            case 'T':
                $rank = 10;
                break;
            case 'J':
                $rank = 11;
                break;
            case 'Q':
                $rank = 12;
                break;
            case 'K':
                $rank = 13;
                break;
            case 'A':
                $rank = $highA ? 14 : 1;
                break;
        }
        return $rank;
    }


}