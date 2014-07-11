<?php 

namespace App\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document */
class Measurement
{
    /** @MongoDB\Id */
    public $id;

    /** @MongoDB\Int */
    public $captor1;

    /** @MongoDB\Int */
    public $captor2;
    
    /** @MongoDB\Date */
    public $datetime;

    public function __construct($captors)
    {
        $this->captor1 = $captors['captor1'];
        $this->captor2 = $captors['captor2'];
        $this->datetime = time();
    }
}
