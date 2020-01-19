<?php

namespace spec\App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Events\TagsWereRemoved;
use App\Domain\Questions\Tag;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class TagsWereRemovedSpec extends ObjectBehavior
{
    private $tags;

    function let()
    {
        $this->tags = [new Tag('test')];
        $this->beConstructedWith($this->tags);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TagsWereRemoved::class);
    }

    function it_has_a_list_of_tags()
    {
        $this->tags()->shouldBe($this->tags);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }
}
