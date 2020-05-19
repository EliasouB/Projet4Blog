<?php



/**
 * 
 */
class Post
{


	/**
     * @var integer
     */
	private $id;

	/**
     * @var string
     */
	private $author;

	/**
     * @var string
     */
	private $title;

	/**
     * @var string
     */
	private $content;

	/**
     * @var datetime
     */
	private $creation_date;


	/**
	 * @param mixed $id
	 */
	public function setId ($id)
	{
		$this->id = $id;
	}

	/**
	 * @param mixed $author
	 */
	public function setAuthor ($author)
	{
		$this->author = $author;
	}

	/**
	 * @return mixed $title
	 */
	public function setTitle ($title)
	{
		$this->title = $title;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent ($content)
	{
		$this->content = $content;
	}

	
	/**
	 * @param mixed $creationDate
	 */
	public function setCreationDate ($creation_date)
	{
		$this->creation_date = $creation_date;
	}


	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed $title 
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}

	
	/**
	 * @return datetime
	 */
	public function getCreationDate()
	{
		return $this->creation_date;
	}
}
