<?php

namespace src\Transportation;


class Train extends AbstractTransportation
{

    protected $transportationNumber;

   
    protected $seat;

    const MESSAGE = 'Take train %s';
    const MESSAGE_FROM_TO = ' from %s to %s. ';
    const MESSAGE_SEAT = 'Sit in seat %s.';

    public function getMessage()
    {
        
        $message = sprintf(static::MESSAGE, $this->transportationNumber);

        
        $message = sprintf(
            $message . static::MESSAGE_FROM_TO,
            $this->departure,
            $this->arrival
        );

       
        $message = sprintf($message . static::MESSAGE_SEAT, $this->seat);

        return $message;
    }
}
