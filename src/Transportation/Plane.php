<?php

namespace src\Transportation;


class Plane extends AbstractTransportation
{

    protected $transportationNumber;

    
    protected $seat;

   
    protected $gate;


    protected $baggage;

    const MESSAGE = 'From %s, take flight %s to %s. Gate %s, seat %s.';
    const MESSAGE_BAGGAGE_TICKET = 'Baggage drop at ticket counter %s.';
    const MESSAGE_NO_BAGGAGE_TICKET = 'Baggage will we automatically transferred from your last leg.';


    public function getMessage()
    {
        $message = sprintf(
            static::MESSAGE,
            $this->departure,
            $this->transportationNumber,
            $this->arrival,
            $this->gate,
            $this->seat
        );

        if (!empty($this->baggage)){
            $message .= sprintf(
                PHP_EOL . '   ' . static::MESSAGE_BAGGAGE_TICKET,
                $this->baggage
            );

            return $message;
        }

      
        $message .= PHP_EOL . '   ' . static::MESSAGE_NO_BAGGAGE_TICKET;

        return $message;
    }
}
