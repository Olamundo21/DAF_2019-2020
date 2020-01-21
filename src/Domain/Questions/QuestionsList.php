<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\UserInterface\Questions;

use App\Application\Questions\QuestionsListQuery;
use App\UserInterface\ApiControllerMethods;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsList extends AbstractController
{

    use ApiControllerMethods;

    /**
     * @var QuestionsListQuery
     */
    private $questionsListQuery;

    public function __construct(QuestionsListQuery $questionsListQuery)
    {
        $this->questionsListQuery = $questionsListQuery;
    }

    /**
     * @return Response
     * @Route("/questions", methods={"GET"})
     */
    public function handle(): Response
    {
        return $this->response($this->questionsListQuery->data());
    }
}
