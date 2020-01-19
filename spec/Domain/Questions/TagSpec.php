<?php

namespace spec\App\Domain\Questions;

use App\Domain\Questions\Tag;
use PhpSpec\ObjectBehavior;

class TagSpec extends ObjectBehavior
{

    private $description;

    function let()
    {
        $this->description = 'php';
        $this->beConstructedWith($this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Tag::class);
    }

    function it_has_a_tag_id()
    {
        $this->tagId()->shouldBeAnInstanceOf(Tag\TagId::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
