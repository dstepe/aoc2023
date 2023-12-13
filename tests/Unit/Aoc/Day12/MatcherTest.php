<?php

namespace Tests\Unit\Aoc\Day12;

use App\Aoc\Day12\Groupings;
use App\Aoc\Day12\Matcher;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MatcherTest extends TestCase
{
    #[DataProvider('matchesPatternChecks')]
    public function testMatchesPattern(array $groupings, string $candidate, bool $expected): void
    {
        $matcher = new Matcher(new Groupings(new Collection($groupings)));

        $this->assertEquals($expected, $matcher->matches($candidate));
    }

    public static function matchesPatternChecks(): array
    {
        return [
            [[1,1,3], '#.#.###', true],
            [[1,1,3], '..#.###', false],
            [[1,1,3], '.#...#....###.', true], // .??..??...?##.
            [[1,1,3], '..#..#....###.', true], // .??..??...?##.
            [[1,1,3], '.#....#...###.', true], // .??..??...?##.
            [[1,1,3], '..#...#...###.', true], // .??..??...?##.
            [[1,1,3], '..#...#....##.', false], // .??..??...?##.
            [[1,1,3], '..##......###.', false], // .??..??...?##.
            [[1,1,3], '.#....##...##.', false], // .??..??...?##.
        ];
    }
}
