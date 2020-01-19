<?php

namespace spec\App\Domain\Questions\Tag;

use App\Domain\Common\RootAggregatorId;
use App\Domain\Questions\Tag\TagId;
use PhpSpec\ObjectBehavior;

class TagIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TagId::class);
    }

    function its_an_aggregate_identifier()
    {
        $this->shouldBeAnInstanceOf(RootAggregatorId::class);
    }
}
