<?php

namespace lab3\Blog\Http\Actions\Articles;

use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\ErrorResponse;
use lab3\Blog\Http\Actions\ActionInterface;
use lab3\Blog\Interfaces\ArticleLikesRepositoryInterface;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;

class GetArticleLikes implements ActionInterface
{
    private ArticleLikesRepositoryInterface $articleLikesRepository;

    public function __construct(
        ArticleLikesRepositoryInterface $articleLikesRepositoryImplementation
    )
    {
        $this->articleLikesRepository = $articleLikesRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        try {
            $articleId = $request->query('uuid');
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $likes = $this->articleLikesRepository->getByPostUuid($articleId);

        return new SuccessfulResponse(['likes' => $likes]);
    }
}