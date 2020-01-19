<?php

namespace spec\App\Domain\Questions\EventListeners;

use App\Domain\Events\DomainEvent;
use App\Domain\Events\EventListener;
use App\Domain\Events\EventPublisher;
use App\Domain\Questions\EventListeners\DeleteOrphanTags;
use App\Domain\Questions\Events\QuestionWasCreated;
use App\Domain\Questions\Events\TagsWereRemoved;
use App\Domain\Questions\Events\TagsWereUpdated;
use App\Domain\Questions\Tag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteOrphanTagsSpec extends ObjectBehavior
{
    function let(EventPublisher $eventPublisher)
    {
        $this->beAnInstanceOf(TestableDeleteOrphanTags::class);
        $this->beConstructedWith($eventPublisher);
        $this->tags = [
            new Tag('1'),
            new Tag('2')
        ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteOrphanTags::class);
    }

    function its_an_event_listener()
    {
        $this->shouldBeAnInstanceOf(EventListener::class);
    }

    function it_handles_update_tags_event(TagsWereUpdated $event)
    {
        $this->handle($event);
        $this->wasCalled()->shouldBe(true);
    }

    function it_only_handles_tags_were_updated_event(QuestionWasCreated $event)
    {
        $this->handle($event);
        $this->wasCalled()->shouldBe(false);
    }

    function it_publishes_tags_were_removed_event(TagsWereUpdated $event, EventPublisher $eventPublisher)
    {
        $this->handle($event);
        /** @var TagsWereRemoved $newEvent */
        $newEvent = Argument::type(TagsWereRemoved::class);
        $eventPublisher
            ->publish($newEvent)
            ->shouldHaveBeenCalled();
    }

    function it_should_not_publishes_tags_when_none_was_removed(TagsWereUpdated $event, EventPublisher $eventPublisher)
    {
        $this->tags = [];
        $this->handle($event);
        /** @var TagsWereRemoved $newEvent */
        $newEvent = Argument::type(TagsWereRemoved::class);
        $eventPublisher
            ->publish($newEvent)
            ->shouldNotHaveBeenCalled();
    }


}


class TestableDeleteOrphanTags extends DeleteOrphanTags
{

    private $wasCalled = false;

    public $tags = [];

    /**
     * @inheritDoc
     */
    protected function deleteOrphanTags(): array
    {
        $this->wasCalled = true;
        return $this->tags;
    }

    public function wasCalled(): bool
    {
        return $this->wasCalled;
    }
}

