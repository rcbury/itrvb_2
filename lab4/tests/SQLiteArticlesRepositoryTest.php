<?php

namespace Tests;

use lab3\Blog\Database\Db;
use lab3\Blog\Article;
use lab3\Blog\Exceptions\EntityNotFoundException;
use lab3\Blog\Repositories\SQLiteArticlesRepository;
use PHPUnit\Framework\TestCase;
use Tests\LoggerMock;
use SQLite3Result;
use SQLite3Stmt;

use function PHPUnit\Framework\assertEquals;

final class SQLiteArticlesRepositoryTest extends TestCase
{
	public function testSave()
	{
		$conn = $this->createStub(Db::class);
		$query = $this->createMock(SQLite3Stmt::class);
		$query->expects($this->once())->method('execute')->with();
		$conn->method('prepare')->WillReturn($query);
		$repository = new SQLiteArticlesRepository($conn, new LoggerMock);
		$article = new Article('xxx', 'xxx', 'xxx', 'xxx');

		$repository->save($article);
	}

	public function testFindById()
	{
		$conn = $this->createStub(Db::class);
		$query = $this->createMock(SQLite3Stmt::class);
		$queryResult = $this->createMock(SQLite3Result::class);
		$query->expects($this->once())->method('execute')->WillReturn($queryResult);
		$queryResult->expects($this->once())
			->method('fetchArray')->with(SQLITE3_ASSOC)->WillReturn(
				[
					'uuid' => 'xxx',
					'content' => 'xxx',
					'header' => 'xxx',
					'author_uuid' => 'xxx'
				]
			);
		$conn->method('prepare')->WillReturn($query);
		$repository = new SQLiteArticlesRepository($conn, new LoggerMock);
		$article = new Article('xxx', 'xxx', 'xxx', 'xxx');

		$result = $repository->get('xxx');

		assertEquals($article, $result);
	}

	public function testExceptionWhenNotFound()
	{
		$conn = $this->createStub(Db::class);
		$query = $this->createStub(SQLite3Stmt::class);
		$query->method('execute')->willReturn(false);
		$conn->method('prepare')->willReturn($query);
		$repository = new SQLiteArticlesRepository($conn, new LoggerMock);
		$this->expectException(EntityNotFoundException::class);

		$uuid = "xxxx";
		$repository->get($uuid);
	}
}