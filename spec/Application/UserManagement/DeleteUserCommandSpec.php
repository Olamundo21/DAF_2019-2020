<?php

namespace spec\App\Application\UserManagement;

use App\Application\UserManagement\DeleteUserCommand;
use App\Domain\UserManagement\User\Email;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteUserCommandSpec extends ObjectBehavior
{
    private $email;

    function let()
    {
        $this->email = new Email('jo@mail.us');
        $this->beConstructedWith($this->email);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteUserCommand::class);
    }

    function it_has_an_email()
    {
        $this->email()->shouldBe($this->email);
    }
}
