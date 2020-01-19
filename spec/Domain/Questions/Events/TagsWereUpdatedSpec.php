<?php

namespace spec\App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Events\TagsWereUpdated;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;

class TagsWereUpdatedSpec extends ObjectBehavior
{
    private $questionId;
    private $tags;

    function let()
    {
        $this->questionId = new QuestionId();
        $this->tags = new ArrayCollection([new Tag('test')]);
        $this->beConstructedWith($this->questionId, $this->tags);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TagsWereUpdated::class);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(\DateTimeImmutable::class);
    }

    function it_has_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function it_has_a_collection_of_tags()
    {
        $this->tags()->shouldBe($this->tags);
    }
}
