<?php

namespace poker;

//一手5张牌
class Hand
{
    //牌力(pair,flush)--->5张单牌
    public $power, $cards;

    public function __construct(Card $c1, Card $c2, Card $c3, Card $c4, Card $c5)
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->cards[] = ${'c' . $i};
        }
        $this->power = $this->getPower();
    }


    /**对五张牌按照数字顺序进行排序
     * @param int $highA 1:A的rank为14, 0:A的rank为1
     * @return array
     */
    public function sortCards($highA = 1, $sort = 1)
    {
        $cards = $this->getCards();
        $sortedCards = [];
        foreach ($cards as $card) {
            $rank = $card->getRankNum($highA);
            $sortedCards[] = ['rank' => $rank, 'suit' => $card->getSuit()];
            if($sort == 1){
                arsort($sortedCards);
            }else{
                asort($sortedCards);
            }
        }
        return $sortedCards;
    }


    public function getCards()
    {
        return $this->cards;
    }


    public function getPower()
    {
        if ($flush = $this->flush()) {
            if ($straight = $this->straight()) {
                if ($straight == 14) {
                    $power = ['level' => 'royalFlush'];
                } else {
                    $power = ['level' => 'straightFlush', 'power' => $straight];
                }
            } else {
                $power = ['level' => 'flush', 'power' => $flush];
            }
            return $power;
        } else {
            if ($straight = $this->straight()) {
                $power = ['level' => 'straight', 'power' => $straight];
                return $power;
            } else {
                $cards = $this->sortCards();
                $ranks = array_column($cards, 'rank');
                //rank->count排序,以count为索引
                $rank2count = array_count_values($ranks);
                arsort($rank2count);
                $values = array_values($rank2count);
                if ($values[0] == 4) {
                    $power['level'] = 'quadruple';
                } elseif ($values[0] == 3) {
                    if ($values[1] == 2) {
                        $power['level'] = 'fullHouse';
                    } else {
                        $power['level'] = 'triple';
                    }
                } elseif ($values[0] == 2) {
                    if ($values[1] == 2) {
                        $power['level'] = 'twoPairs';
                    } else {
                        $power['level'] = 'pair';
                    }
                } else {
                    $power['level'] = 'high';
                }
                $power['power'] = array_keys($rank2count);
                return $power;
            }
        }
    }

    /**判断牌型是否为顺子
     * @return mixed 如果是顺子则返回high card,否则返回false
     */
    private function straight()
    {
        for ($i = 0; $i < 2; $i++) {
            $cards = $this->sortCards($i);
            $ranks = array_column($cards, 'rank');
            $check = 1;
            for ($j = 0; $j < 4; $j++) {
                if ($ranks[$j] - $ranks[$j + 1] != 1) {
                    $check = 0;
                    continue;
                }
            }
            if ($check) return $ranks[0];
        }
        return false;
    }

    private function flush()
    {
        $cards = $this->sortCards();
        $suits = array_column($cards, 'suit');
        if (count(array_unique($suits)) == 1) {
            $ranks = array_column($cards, 'rank');
            return $ranks;
        }
        return false;
    }


}