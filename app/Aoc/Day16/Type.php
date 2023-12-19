<?php

namespace App\Aoc\Day16;

enum Type: string
{
    case Space = '.';
    case RightUp = '/';
    case LeftUp = '\\';
    case Vertical = '|';
    case Horizontal = '-';
}
