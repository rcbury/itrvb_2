<?php

namespace lab3\Blog\Http\Actions\Articles;

use Exception;
use lab3\Blog\Article;
use lab3\Blog\Http\ErrorResponse;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;
use lab3\Blog\Http\SuccessfulResponse;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use lab3\Blog\Exceptions\HttpException;
use lab3\Blog\Http\Actions\ActionInterface;

class CreateArticle implements ActionInterface
{
    private ArticlesRepositoryInterface $articlesRepository;

    public function __construct(ArticlesRepositoryInterface $articlesRepositoryImplementation = null)
    {
        $this->articlesRepository = $articlesRepositoryImplementation;
    }

    public function handle(Request $request): Response
	{
        $newUuid = uniqid();

        try {
            $article = new Article(
                $newUuid,
                $request->jsonBodyField('author_uuid'),
                $request->jsonBodyField('header'),
                $request->jsonBodyField('content')
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        if (strlen($article->author_uuid) != 13 or !preg_match("/^[a-zA-Z0-9]+$/",$article->author_uuid)){
            return new ErrorResponse('Author id is invalid');
        }

        try {
            $this->articlesRepository->save($article);
        } catch (Exception $exception){
            return new ErrorResponse('Cannot save article');
        }

        return new SuccessfulResponse([
            'uuid' => (string)$newUuid,
        ]);
    }
}