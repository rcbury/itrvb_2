<?php

namespace lab3\Blog\Http\Actions\Comments;

use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\Actions\ActionInterface;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;
use lab3\Blog\Http\ErrorResponse;


class GetComment implements ActionInterface
{
    private CommentsRepositoryInterface $commentsRepository;

    public function __construct(
        CommentsRepositoryInterface $commentsRepositoryImplementation
    )
    {
        $this->commentsRepository = $commentsRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        try {
            $commentId = $request->query('uuid');
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $comment = $this->commentsRepository->get($commentId);

        return new SuccessfulResponse(['comment' => $comment]);
    }
}