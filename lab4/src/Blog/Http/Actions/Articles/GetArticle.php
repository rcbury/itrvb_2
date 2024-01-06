<?php

namespace lab3\Blog\Http\Actions\Articles;

use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\ErrorResponse;
use lab3\Blog\Http\Actions\ActionInterface;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;

class GetArticle implements ActionInterface
{
    private ArticlesRepositoryInterface $articlesRepository;

    public function __construct(
        ArticlesRepositoryInterface $articlesRepositoryImplementation
    )
    {
        $this->articlesRepository = $articlesRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        try {
            $articleId = $request->query('uuid');
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $article = $this->articlesRepository->get($articleId);

        return new SuccessfulResponse(['article' => $article]);
    }
}