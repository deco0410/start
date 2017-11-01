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
     * @param string $sort desc(默认降序排列) ;asc
     * @return array
     */
    public function sortCards($highA = 1, $sort = 'desc')
    {
        $cards = $this->getCards();
        $sortedCards = [];
        foreach ($cards as $card) {
            $rank = $card->getRankNum($highA);
            $sortedCards[] = ['rank' => $rank, 'suit' => $card->getSuit()];
            if ($sort == 'desc') {
                arsort($sortedCards);
            } elseif ($sort == 'asc') {
                asort($sortedCards);
            }
        }
        return $sortedCards;
    }


    public function getCards()
    {
        return $this->cards;
    }

    public static function compare(Hand $h1, Hand $h2)
    {
        $levels = ['high' => 1, 'pair' => 2, 'twoPairs' => 3, 'triple' => 4, 'straight' => 5, 'flush' => 6,
            'fullHouse' => 7, 'quadruple' => 8, 'straightFlush' => 9, 'royalFlush' => 10];
        $power1 = $h1->power;
        $power2 = $h2->power;
        $level1 = $levels[$power1['pattern']];
        $level2 = $levels[$power2['pattern']];
        if ($level1 > $level2) {
            return 'bigger';
        } elseif ($level1 < $level2) {
            return 'smaller';
            //牌型相同比较踢脚
        } else {
            if(!is_array($power1['power'])){
               if($power1['power'] > $power2['power']){
                   return 'bigger';
               }elseif($power1['power'] < $power2['power']){
                   return 'smaller';
               }else{
                  return 'equal';
               }
            }else{
                for ($i = 0; $i < count($power1['power']); $i++) {
                if ($power1['power'][$i] < $power2['power'][$i]) {
                    return 'smaller';
                } elseif ($power1['power'][$i] > $power2['power'][$i]) {
                    return 'bigger';
                }
            }
            return 'equal';
            }
        }
    }


    /**获得5张牌的牌力
     * @return array pattern为牌型， power为踢脚
     */
    public function getPower()
    {
        if ($flush = $this->flush()) {
            if ($straight = $this->straight()) {
                if ($straight == 14) {
                    $power = ['pattern' => 'royalFlush'];
                } else {
                    $power = ['pattern' => 'straightFlush', 'power' => $straight];
                }
            } else {
                $power = ['pattern' => 'flush', 'power' => $flush];
            }
            return $power;
        } else {
            if ($straight = $this->straight()) {
                $power = ['pattern' => 'straight', 'power' => $straight];
                return $power;
            } else {
                $cards = $this->sortCards();
                $ranks = array_column($cards, 'rank');
                //rank->count排序,以count为索引
                $rank2count = array_count_values($ranks);
                arsort($rank2count);
                $values = array_values($rank2count);
                if ($values[0] == 4) {
                    $power = ['pattern' => 'quadruple', 'power' => array_keys($rank2count)];
                    return $power;
                } elseif ($values[0] == 3) {
                    if ($values[1] == 2) {
                        $power = ['pattern' => 'fullHouse', 'power' => array_keys($rank2count)];
                    } else {
                        //三条的rank
                        $keys = array_keys($rank2count);
                        $key = array_slice($keys, 0, 1);
                        $kicker = array_slice($keys, 1);
                        rsort($kicker);
                        //将踢脚降序排列
                        $sorted = array_merge($key, $kicker);
                        $power = ['pattern' => 'triple', 'power' => $sorted];
                    }
                    return $power;
                } elseif ($values[0] == 2) {
                    if ($values[1] == 2) {
                        $keys = array_keys($rank2count);
                        $key = array_slice($keys, 0, 2);
                        rsort($key);
                        $kicker = array_slice($keys, 2);
                        $sorted = array_merge($key, $kicker);
                        $power = ['pattern' => 'twoPairs', 'power' => $sorted];
                    } else {
                        $keys = array_keys($rank2count);
                        $key = array_slice($keys, 0, 1);
                        $kicker = array_slice($keys, 1);
                        rsort($kicker);
                        //将踢脚降序排列
                        $sorted = array_merge($key, $kicker);
                        $power = ['pattern' => 'pair', 'power' => $sorted];
                    }
                    return $power;
                } else {
                    $keys = array_keys($rank2count);
                    rsort($keys);
                    $power = ['pattern' => 'high', 'power' => $keys];
                    return $power;
                }
            }
        }
    }


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