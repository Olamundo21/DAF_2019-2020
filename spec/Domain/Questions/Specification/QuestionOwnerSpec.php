<?php

namespace spec\App\Domain\Questions\Specification;

use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionSpecification;
use App\Domain\Questions\Specification\QuestionOwner;
use App\Domain\UserManagement\User;
use App\Domain\UserManagement\UserIdentifier;
use PhpSpec\ObjectBehavior;

class QuestionOwnerSpec extends ObjectBehavior
{
    private $userId;

    function let(UserIdentifier $identifier, User $loggedInUser)
    {
        $this->userId = new User\UserId();

        $loggedInUser->userId()->willReturn($this->userId);
        $identifier->currentUser()->willReturn($loggedInUser);

        $this->beConstructedWith($identifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(QuestionOwner::class);
    }

    function its_a_question_specification()
    {
        $this->shouldBeAnInstanceOf(QuestionSpecification::class);
    }

    function it_check_true_when_owner_is_current_logged_in_user(Question $question)
    {
        $question->userId()->willReturn($this->userId);
        $this->isSatisfiedBy($question)->shouldBe(true);
    }

    function it_check_false_when_owner_is_note_current_user(Question $question)
    {
        $question->userId()->willReturn(new User\UserId());
        $this->isSatisfiedBy($question)->shouldBe(false);
    }
}
