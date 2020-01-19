<?php


namespace spec\App\Domain\Answers\Answer;


use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Common\RootAggregatorId;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Stringable;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class AnswerIdSpec extends ObjectBehavior
{
    private $uuid;

    function let()
    {
        $this->uuid = (string) Uuid::uuid4();
        $this->beConstructedWith($this->uuid);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerId::class);
    }

    function its_an_aggregator()
    {
        $this->shouldBeAnInstanceOf(RootAggregatorId::class);
    }

    function it_can_be_treated_as_a_string()
    {
        $this->shouldBeAnInstanceOf(Stringable::class);
        $this->__toString()->shouldBe($this->uuid);
    }
}