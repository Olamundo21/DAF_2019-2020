<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UserInterface\Command\UserManagement;

use App\Application\UserManagement\DeleteUserCommand;
use App\Domain\UserManagement\User\Email;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * UsersRemoveCommand
 *
 * @package App\Command\UserManagement
 */
final class UsersRemoveCommand extends Command
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var SymfonyStyle
     */
    private $style;

    /**
     * @var false
     */
    private $continue;

    /**
     * Creates a UsersRemoveCommand
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        parent::__construct('users:remove');
        $this->commandBus = $commandBus;
    }

    public function configure()
    {
        parent::configure();
        $this
            ->setHelp('Removes a user by its e-mail address')
            ->addArgument('email', InputArgument::REQUIRED, "User's e-mail address.")
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->email = new Email($input->getArgument('email'));
        $this->style = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        $this->style->title("Remove user");
        $this->continue = $this->style->askQuestion(
            new ConfirmationQuestion(
                'Are you sure you want do delete user with e-mail ' . $this->email,
                false
            )
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->continue) {
            $this->style->text("Operation cancelled.");
            return 0;
        }

        try {
            $this->commandBus->handle(new DeleteUserCommand($this->email));
        } catch (\Throwable $e) {
            $this->style->error($e->getMessage());
            return 1;
        }

        $this->style->success("User with e-mail {$this->email} successfully removed.");
        return 0;
    }
}
