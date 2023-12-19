<?php

namespace App\Aoc\Day16;

enum Direction: string
{
    case Right = '>';
    case Down = 'v';
    case Left = '<';
    case Up = '^';
}
