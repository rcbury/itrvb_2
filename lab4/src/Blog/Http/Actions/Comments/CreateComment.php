<?php

namespace lab3\Blog\Http\Actions\Comments;

use Exception;
use lab3\Blog\Comment;
use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\Actions\ActionInterface;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;
use lab3\Blog\Http\ErrorResponse;

class CreateComment implements ActionInterface
{
    private CommentsRepositoryInterface $commentsRepository;

    public function __construct(CommentsRepositoryInterface $commentsRepositoryImplementation)
    {
        $this->commentsRepository = $commentsRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        $newUuid = uniqid();

        try {
            $comment = new Comment(
                $newUuid,
                $request->jsonBodyField('author_uuid'),
                $request->jsonBodyField('post_uuid'),
                $request->jsonBodyField('text')
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        try {
            $this->commentsRepository->save($comment);
        } catch (Exception $exception){
            return new ErrorResponse('Cannot save article');
        }

        return new SuccessfulResponse([
            'uuid' => (string)$newUuid,
        ]);
    }
}