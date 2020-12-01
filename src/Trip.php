<?php

namespace src;

/**
 * Class Trip
 *
 * @package src
 */
class Trip
{
    /**
     * Boardings
     *
     * @var array
     */
    protected $boardings = array();


    protected $sortedBoardings = array();

    protected static $transportations = array(
        'Train' => 'src\Transportation\Train',
        'Bus' => 'src\Transportation\Bus',
        'Plane' => 'src\Transportation\Plane',
    );

    function __construct($boardings)
    {
        $this->boardings = $boardings;
    }

    public function addBoarding($boarding)
    {
        $this->boardings[] = $boarding;
    }

    
    public function sort()
    {
         
        $boardingSorter = new BoardingSorter($this->boardings);
         
        $boardingSorter->sort();
        $this->sortedBoardings = $boardingSorter->getBoardings();
    }

    
    public function getTransportations()
    {
        $transportationList = array();

        if (count($this->sortedBoardings) == 0) {
            return $transportationList;
        }

        foreach ($this->sortedBoardings as $boarding) {
            $type = $boarding['Transportation'];

            if (!isset(static::$transportations[$type])){
                throw new Exception\RuntimeException(
                    sprintf(
                        'Unsupported transportation : %s',
                        $type
                    )
                );
            }
            $transportationList[] = new static::$transportations[$type]($boarding);
        }

        return $transportationList;

    }

    
    public function tripString()
    {
        foreach ($this->getTransportations() as $idx => $transportaton) {
            
            echo ($idx + 1) . ". " . $transportaton->getMessage() . PHP_EOL . PHP_EOL;
        
            if($idx == (count($this->boardings) -1) ){
                echo ($idx + 2) . ". " .  $transportaton::MESSAGE_FINAL_DESTINATION . PHP_EOL;
            }
        }

    }

    
    public function getBoardings()
    {
        return $this->boardings;
    }

    public function getSortedBoardings()
    {
        return $this->sortedBoardings;
    }
}
