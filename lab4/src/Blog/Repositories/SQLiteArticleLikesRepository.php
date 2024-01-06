<?php 

namespace lab3\Blog\Repositories;

use Psr\Log\LoggerInterface;
use lab3\Blog\Interfaces\ArticleLikesRepositoryInterface;
use lab3\Blog\ArticleLike;
use lab3\Blog\Exceptions\EntityNotFoundException;
use lab3\Blog\Exceptions\OperationNotAllowedException;
use SQLite3;

class SQLiteArticleLikesRepository implements ArticleLikesRepositoryInterface
{
    public SQLite3 $db;
	private LoggerInterface $logger;

	public function __construct(SQLite3 $db = null, LoggerInterface $logger)
	{
		$this->db = $db;
		$this->logger = $logger;
	}

    public function save(ArticleLike $like) 
    {
		$this->logger->info("Article like save ".$like->uuid);

		$result = $this->isLikeExists($like->article_uuid, $like->user_uuid);

		if ($result){
			throw new OperationNotAllowedException("like post more than once");
		}
        $query = $this->db->prepare(
			'INSERT INTO likes (uuid, article_uuid, user_uuid)
			VALUES (:uuid, :article_uuid, :user_uuid)'
		);
		$query->bindValue(':uuid', $like->uuid);
		$query->bindValue(':article_uuid',$like->article_uuid);
		$query->bindValue(':user_uuid', $like->user_uuid);
		$query->execute();
    }

	public function isLikeExists(string $article_uuid, string $user_uuid)
    {
		$query = $this->db->prepare('SELECT * FROM likes 
			WHERE article_uuid=:article_uuid AND user_uuid=:user_uuid');
		$query->bindValue(':article_uuid', $article_uuid);
		$query->bindValue(':user_uuid', $user_uuid);

		$result = $query->execute();
		
		if ($result === false) {
			throw new EntityNotFoundException();
		}

		$likes = [];

		while ($row = $result->fetchArray(SQLITE3_ASSOC)){


			$like = new ArticleLike(
				$row["uuid"],
				$row["article_uuid"],
				$row["user_uuid"],
			);

			array_push($likes, $like);

		}

		if (count($likes) > 0) 
		{
			return true;
		}

		return false;
        
    }
    
    public function getByPostUuid(string $uuid) 
    {
		$query = $this->db->prepare('SELECT * FROM likes WHERE article_uuid=:uuid');
		$query->bindValue(':uuid', $uuid);
		$result = $query->execute();
		if ($result === false) {
			$this->logger->warning("Likes for object not found ".$uuid);
			throw new EntityNotFoundException();
		}
		$likes = [];

		while ($row = $result->fetchArray(SQLITE3_ASSOC))
		{
			$like = new ArticleLike(
				$row["uuid"],
				$row["article_uuid"],
				$row["user_uuid"]
			);
			array_push($likes, $like);
		}
		return $likes;
    }
}

?>
