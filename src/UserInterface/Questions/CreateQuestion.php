<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\UserInterface\Questions;

use App\Application\Questions\AddQuestionCommand;
use App\Domain\UserManagement\User;
use App\Domain\UserManagement\UserIdentifier;
use App\UserInterface\ApiControllerMethods;
use App\UserInterface\UserManagement\OAuth2\AuthenticatedControllerInterface;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateQuestion extends AbstractController implements AuthenticatedControllerInterface
{
    use ApiControllerMethods;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var User
     */
    private $user;

    /**
     * Creates a CreateQuestion
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/questions", methods={"POST"})
     */
    public function handle(Request $request)
    {
        $data = $this->parseRequest($request, ['question', 'description']);
        if (!$this->valid) {
            return $this->badRequest('Please check your question data.');
        }

        $command = new AddQuestionCommand(
            $this->currentUser()->userId(),
            $data->question,
            $data->description
        );

        try {
            $question = $this->commandBus->handle($command);
        } catch (\Throwable $throwable) {
            return $this->badRequest(
                $throwable->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->response($question);
    }

    /**
     * @inheritDoc
     */
    public function currentUser(): User
    {
        return $this->user;
    }

    /**
     * @inheritDoc
     */
    public function withCurrentUser(User $user): AuthenticatedControllerInterface
    {
        $this->user = $user;
        return $this;
    }
}
