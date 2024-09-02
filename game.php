<?php 

class Game{

    //number of pairs

    private $_pairs_nb;

    //determine if game is ongoing

    private $_status;

    //contain cards

    private array $_cards;

    public function createBoard(){

        for ($i = 0; $i < $this->_pairs_nb * 2; $i++){
            $card = new Card();
            $card->setId($i+1);
            $card->setName($i % $this->_pairs_nb + 1);
            //$card->setName(rand(1, $this->_pairs_nb));
            $this->_cards[] = $card;
        }

        shuffle($this->_cards);
    }
    //set session variables to instanciated Game, and id of cards to compare them when clicked 
    
    public function start(): ?Game{
    
        if (session_status() == PHP_SESSION_ACTIVE){
            $_SESSION["game"] = $this;
            $cards= [];
            foreach ($this->_cards as $card){
                $cards[] = $card->getId();
            }
            $_SESSION['cards'] = $cards;
            return $this;
        }

    }

    //return html from cards

    public function toHtml(){
        $board = '';
        foreach ($this->_cards as $card){
            $board .= $card->toHtml();
        }
        return $board;

    }

    //set status of recto cards to paired, used if cards have the same name in checkCards() method

    private function pairCards(){
        foreach ($this->_cards as $card){
            if ($card->getStatus() === 'recto'){
                $card->setStatus('paired');
            }
        }
    }

    /* Check if there is two or more flipped cards */

    public function checkCards(){
        foreach ($this->_cards as $card){
            if (count($recto_cards) > 1){
                if ($recto_cards[0] === $recto_cards[1]){
                    $this->pairCards();
                }else{
                    foreach($this ->_cards as $c){
                        if ($c->getStatus() === 'recto'){
                            $c->flip();
                        }
                    }
                }
                break;
            }elseif ($card->getStatus() === 'recto'){
                $recto_cards[] = $card->getName();
            }
        }
        var_dump($recto_cards);
    }
    public function getPairsNb(){
        return $this->_pairs_nb;
    }

    public function setPairsNb($pairs_nb){
        $this ->_pairs_nb = $pairs_nb;
    }

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus($status){
        $this->_status = $status;
    }

    public function getCards(){
        return $this->_cards;
    }

    public function setCards($cards){
        $this->_cards = $cards;
    }

}