<?php 

namespace lab3\Blog\Repositories;

use Psr\Log\LoggerInterface;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Comment;
use lab3\Blog\Exceptions\EntityNotFoundException;
use SQLite3;

class SQLiteCommentsRepository implements CommentsRepositoryInterface
{
    public SQLite3 $db;
	private LoggerInterface $logger;

	public function __construct(SQLite3 $db = null, LoggerInterface $logger)
	{
		$this->db = $db;
		$this->logger = $logger;
	}

    public function save(Comment $comment) 
    {
		$this->logger->info("Comment save ".$article->uuid);

        $query = $this->db->prepare(
			'INSERT INTO comments (uuid, article_uuid, content, author_uuid)
			VALUES (:uuid, :article_uuid, :content, :author_uuid) 
			ON CONFLICT(uuid) 
			DO UPDATE SET 
			article_uuid=excluded.article_uuid, content=excluded.content, author_uuid=excluded.author_uuid;'
		);
		$query->bindValue(':uuid', $comment->uuid);
		$query->bindValue(':article_uuid',$comment->article_uuid);
		$query->bindValue(':content', $comment->content);
		$query->bindValue(':author_uuid', $comment->author_uuid);
		$query->execute();
    }
    
    public function get(string $uuid) 
    {
		$query = $this->db->prepare('SELECT * FROM comments WHERE uuid=:uuid');
		$query->bindValue(':uuid', $uuid);
		$result = $query->execute();
		if ($result === false) {
			$this->logger->warning("Comment not found ".$uuid);
			throw new EntityNotFoundException();
		}
		$result = $result->fetchArray(SQLITE3_ASSOC);
		if ($result === false) {
			$this->logger->warning("Comment not found ".$uuid);
			throw new EntityNotFoundException();
		}
		$comment = new Comment(
			content: $result["content"],
			uuid: $result["uuid"],
			article_uuid: $result["article_uuid"],
			author_uuid: $result["author_uuid"],
		);
		return $comment;
    }
}

?>
