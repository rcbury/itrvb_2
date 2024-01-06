<?php

namespace lab3\Blog\Http\Actions\ArticleLikes;

use lab3\Blog\ArticleLike;
use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\ErrorResponse;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;
use lab3\Blog\Entities\Comment;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Http\Actions\ActionInterface;
use lab3\Blog\Interfaces\ArticleLikesRepositoryInterface;

class LikeArticle implements ActionInterface
{
    private ArticleLikesRepositoryInterface $articleLikesRepository;

    public function __construct(
        ArticleLikesRepositoryInterface $articleLikesRepositoryImplementation,
    )
    {
        $this->articleLikesRepository = $articleLikesRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        $newUuid = uniqid();

        try {
            $like = new ArticleLike(
                $newUuid,
                $request->jsonBodyField('article_uuid'),
                $request->jsonBodyField('user_uuid')
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->articleLikesRepository->save($like);

        return new SuccessfulResponse([
            'uuid' => (string)$newUuid,
        ]);
    }
}