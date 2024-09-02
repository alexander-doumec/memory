<?php

class Card
{
    //identify Cards

    private $_id;

    //determine card image / pair

    private $_name;
    
    private $_status;

    public function __construct()
    {
        $this->_status = 'verso';
    }

    public function flip()
    {
        if ($this->_status === 'verso') {
            $this->_status = 'recto';
        } elseif ($this->_status === 'recto') {
            $this->_status = 'verso';
        }
    }

    public function toHtml()
    {
        switch ($this->_status) {
            case 'verso':
                return '<button type="submit" name="card" value=""' . $this->_id . '" class="card verso"><img src="memory-game/pictures/verso.png" alt="verso"></button>';
                break;
            case 'recto':
                return '<div class="card recto"><img src="memory-game/pictures/' . $this->_name . '.png" alt="recto image' . $this->_name . '"></div>';
                break;
            case 'paired':
                return '<div class="card found"><img src="memory-game/pictures/' . $this->_name . '' . $this->_name . '.png" alt="' . $this->_name . 'found"></div>';
                break;
        }
    }

    public function getId(){
        return $this->_id;
    }

    public function setId($id){
        $this->_id = $id;
    }

    public function getName(){
        return $this->_name;
    }
    public function setName($name){
        $this->_name = $name;
    }

    public function getStatus(){
        return $this->_status;
    }

    public function setStatus($status){
        $this->_status = $status;
    }
}
