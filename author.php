<?php
/**
 * COPS (Calibre OPDS PHP Server) class file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     S�bastien Lucas <sebastien@slucas.fr>
 */

require_once('base.php');

class Author extends Base {
    const ALL_AUTHORS_ID = "calibre:authors";
    
    public $id;
    public $name;
    public $sort;
    
    public function __construct($pid, $pname) {
        $this->id = $pid;
        $this->name = $pname;
    }
    
    public function getUri () {
        return "/author_detail/$this->id";
    }
    
    public function getEntryId () {
        return self::ALL_AUTHORS_ID.":".$this->id;
    }


    public static function getCount() {
        $nAuthors = parent::getDb ()->query('select count(*) from authors')->fetchColumn();
        $entry = new Entry (localize("authors.title"), self::ALL_AUTHORS_ID, 
            str_format (localize("authors.alphabetical"), $nAuthors), "text", 
            array ( new LinkNavigation ("/all_author/")));
        return $entry;
    }
    
    public static function getAllAuthors() {
        $result = parent::getDb ()->query('select authors.id as id, authors.name as name, authors.sort as sort, count(*) as count
from authors, books_authors_link
where author = authors.id
group by authors.id, authors.name, authors.sort
order by sort');
        $entryArray = array();
        while ($post = $result->fetchObject ())
        {
            $author = new Author ($post->id, $post->sort);
            array_push ($entryArray, new Entry ($post->sort, $author->getEntryId (), 
                str_format (localize("bookword.many"), $post->count), "text", 
                array ( new LinkNavigation ($author->getUri ()))));
        }
        return $entryArray;
    }
        
    public static function getAuthorById ($authorId) {
        $result = parent::getDb ()->prepare('select sort from authors where id = ?');
        $result->execute (array ($authorId));
        return new Author ($authorId, $result->fetchColumn ());
    }
    
    public static function getAuthorByBookId ($bookId) {
        $result = parent::getDb ()->prepare('select authors.id as id, authors.sort as sort
from authors, books_authors_link
where author = authors.id
and book = ?');
        $result->execute (array ($bookId));
        $authorArray = array ();
        while ($post = $result->fetchObject ()) {
            array_push ($authorArray, new Author ($post->id, $post->sort));
        }
        return $authorArray;
    }
}
?>