<?php

namespace App\Controller;

use League\Plates\Engine;

abstract class PageController {

    protected $View;

    public function __construct() {
        $this->View = new Engine(__DIR__.'../../view', 'php');
    }
    
}