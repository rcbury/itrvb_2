<?php

namespace lab3\Blog\Repositories;

use Psr\Log\LoggerInterface;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use lab3\Blog\Article;
use lab3\Blog\Exceptions\EntityNotFoundException;
use SQLite3;

class SQLiteArticlesRepository implements ArticlesRepositoryInterface
{
    public SQLite3 $db;
	private LoggerInterface $logger;

	public function __construct(SQLite3 $db = null, LoggerInterface $logger)
	{
		$this->db = $db;
		$this->logger = $logger;
	}

    public function save(Article $article) 
    {
		$this->logger->info("Article save ".$article->uuid);

		$query = $this->db->prepare(
			'INSERT INTO articles (uuid, header, content, author_uuid)
			VALUES(:uuid, :header, :content, :author_uuid) 
			ON CONFLICT(uuid) 
			DO UPDATE SET 
			header=excluded.header, content=excluded.content, author_uuid=excluded.author_uuid;'
		);
		$query->bindValue(':uuid', $article->uuid);
		$query->bindValue(':header', $article->header);
		$query->bindValue(':content', $article->content);
		$query->bindValue(':author_uuid', $article->author_uuid);
		$query->execute();
    }

    public function get(string $uuid) 
    {
		$query = $this->db->prepare('SELECT * FROM articles WHERE uuid=:uuid');
		$query->bindValue(':uuid', $uuid);
		$result = $query->execute();
		if ($result === false) {
			$this->logger->warning("Article not found ".$uuid);
			throw new EntityNotFoundException();
		}
		$result = $result->fetchArray(SQLITE3_ASSOC);
		if ($result === false) {
			$this->logger->warning("Article not found ".$uuid);
			throw new EntityNotFoundException();
		}
		$article = new Article(
			content: $result["content"],
			uuid: $result["uuid"],
			header: $result["header"],
			author_uuid: $result["author_uuid"],
		);
		return $article;
    }

    public function delete(string $uuid)
	{
		$query = $this->db->prepare('DELETE FROM articles WHERE uuid=:uuid');
		$query->bindValue(':uuid', $uuid);
		$result = $query->execute();
		if ($result === false) {
			throw new EntityNotFoundException();
		}
	}
}

?>