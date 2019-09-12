<?php



/**
 * 
 */
class Post
{
	
	private $id;
	private $author;
	private $title;
	private $content;
	private $resume;
	private $creation_date;

	public function setId ($id)
	{
		$this->id = $id;
	}

	public function setAuthor ($author)
	{
		$this->author = $author;
	}

	public function setTitle ($title)
	{
		$this->title = $title;
	}

	public function setContent ($content)
	{
		$this->content = $content;
	}

	public function setResume ($resume)
	{
		$this->resume = $resume;
	}

	public function setCreationDate ($creation_date)
	{
		$this->creation_date = $creation_date;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getResume ()
	{
		return $this->resume;
	}

	public function getCreationDate()
	{
		return $this->creation_date;
	}
}
