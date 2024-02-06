<?php

    namespace App\Enums;


    enum TicketsStatus:string 
    {
    case OPEN = 'open';
    case REJECTED = 'rejected';
    case RESOLVED = 'resolved';
    }


