<?php

namespace src\Transportation;

abstract class AbstractTransportation implements TransportationInterface
{

   
    protected $departure;

    protected $arrival;

    const MESSAGE_FINAL_DESTINATION = 'You have arrived at your final destination.';

  
    public function __construct(array $trip)
    {
        foreach ($trip as $key => $value) {
            
            $property = lcfirst($key);

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

}
