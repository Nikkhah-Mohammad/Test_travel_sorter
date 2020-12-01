<?php

namespace src;


class BoardingSorter
{
    
    protected $boardings = array();

    function __construct($boardings)
    {
        $this->boardings = $boardings;
    }

    public function sort()
    {
        
        $this->setFirstLastBoarding();

        
        for ($i=0, $max = count($this->boardings) -1 ; $i < $max ; $i++) {
     
            foreach ($this->boardings as $idx => $trip) {
             
                if (strcasecmp($this->boardings[$i]['Arrival'], $trip['Departure']) == 0) {
                    $nextIdx = $i + 1;
                    $tempBoarding = $this->boardings[$nextIdx];
                    $this->boardings[$nextIdx] = $trip;
                    $this->boardings[$idx] = $tempBoarding;
                }
            }
        }
    }

    private function setFirstLastBoarding()
    {
        $isLastBoarding = true;
        $hasPrevBoarding = false;

        for ($i=0, $max = count($this->boardings); $i < $max ; $i++) {
        
            foreach ($this->boardings as $trip) {
              
                if (strcasecmp($this->boardings[$i]['Departure'], $trip['Arrival']) == 0) {
                    $hasPrevBoarding = true;
                }
               
                elseif (strcasecmp($this->boardings[$i]['Arrival'], $trip['Departure']) == 0) {
                    $isLastBoarding = false;
                }
            }

         
            if (!$hasPrevBoarding) {
                
                array_unshift($this->boardings, $this->boardings[$i]);
                unset($this->boardings[$i]);
            }
            elseif ($isLastBoarding) {
                
                array_push($this->boardings, $this->boardings[$i]);
                unset($this->boardings[$i]);
            }
        }

       
        $this->boardings = array_merge($this->boardings);
    }

    
    public function getBoardings()
    {
        return $this->boardings;
    }
}
