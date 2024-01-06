<?php

namespace Tests;

use Exception;
use lab3\Blog\Article;
use lab3\Blog\User;
use lab3\Blog\Exceptions\EntityNotFoundException;
use lab3\Blog\Http\Actions\Articles\CreateArticle;
use lab3\Blog\Http\ErrorResponse;
use lab3\Blog\Http\Request;
use lab3\Blog\Http\SuccessfulResponse;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

final class CreateArticleActionTest extends TestCase
{
	private function getArticlesRepository(array $articles, array $users): ArticlesRepositoryInterface
    {
        return new class($articles, $users) implements ArticlesRepositoryInterface
        {
            public function __construct(
                private array $articles,
                private array $users
            ) {
            }

            public function save(Article $article): void
            {
                $user_exists = false;
                foreach ($this->users as $user) {
                    if ($user->uuid == $article->author_uuid) {
                        $user_exists = true;
                        break;
                    }
                }

                if (!$user_exists) {
                    throw new Exception();
                }

                array_push($this->articles, $article);
            }

            public function get(string $uuid): Article
            {
                throw new EntityNotFoundException();
            }

            public function delete(string $uuid)
            {
                throw new Exception();
            }
        };
    }

	function testSuccess() 
	{
		$request = new Request([], [], '{
            "author_uuid": "xxxxxxxxxxxxx",
            "header": "header",
            "content": "content"
        }');
        $repository = $this->getArticlesRepository([], [new User('xxxxxxxxxxxxx', 'name', 'surname', 'nick')]);
        $action = new CreateArticle($repository);
        $response = $action->handle($request);

        $this->assertInstanceOf(SuccessfulResponse::class, $response);
        $response->send();
	}
	
	function testUuid() 
	{
		$request = new Request([], [], '{
            "author_uuid": "xxxxxxxxxxxx_",
            "header": "header",
            "content": "content"
        }');
        $repository = $this->getArticlesRepository([], [new User('xxxxxxxxxxxxx', 'name', 'surname', 'nick')]);
        $action = new CreateArticle($repository);
        $response = $action->handle($request);

        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->expectOutputString('{"success":false,"reason":"Author id is invalid"}');

        $response->send();
	}

	function testNotFoundUserUuid() 
	{
		$request = new Request([], [], '{
            "author_uuid": "xxxxxxxxxxxxy",
            "header": "header",
            "content": "content"
        }');
        $repository = $this->getArticlesRepository([], [new User('xxxxxxxxxxxxx', 'name', 'surname', 'nick')]);
        $action = new CreateArticle($repository);
        $response = $action->handle($request);
        
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->expectOutputString('{"success":false,"reason":"Cannot save article"}');

        $response->send();
	}

	function testNotEnoughData() 
	{
		$request = new Request([], [], '{
            "author_uuid": "xxxxxxxxxxxxx",
            "header": "header",
        }');
        $repository = $this->getArticlesRepository([], [new User('xxxxxxxxxxxxx', 'name', 'surname', 'nick')]);
        $action = new CreateArticle($repository);
        $response = $action->handle($request);

        $this->assertInstanceOf(ErrorResponse::class, $response);

        $response->send();
	}
}