<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>

<?php

class Book {
    public $title; 
    protected $author; 
    private $price; 

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}";
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function __call($name, $arguments) {
        if ($name == 'updateStock') {
            return "Stock updated for '{$this->title}' with arguments: " . implode(", ", $arguments);
        } else {
            return "Method '{$name}' does not exist.";
        }
    }
}

class Library {
    private $books = []; 
    public $name; 

    public function __construct($name) {
        $this->name = $name;
    }

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function removeBook($title) {
        foreach ($this->books as $index => $book) {
            if ($book->title == $title) {
                unset($this->books[$index]);
                return "Book '{$title}' removed from the library.";
            }
        }
        return "Book '{$title}' not found in the library.";
    }

    public function listBooks() {
        if (empty($this->books)) {
            return "No books in the library.";
        }

        $output = "Books in the library:\n";
        foreach ($this->books as $book) {
            $output .= $book->getDetails() . "\n";
        }
        return $output;
    }

    public function __destruct() {
        echo "The library '{$this->name}' is now closed.\n";
    }
}

$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 12.99);
$book2 = new Book("1984", "George Orwell", 8.99);

$library = new Library("City Library");

$library->addBook($book1);
$library->addBook($book2);

echo $book1->setPrice(12.99) . "<br>"; 
echo $book1->updateStock(50) . "<br>"; 

echo $library->removeBook("1984") . "<br>";

echo "Books in the library after removal:<br>";
echo $library->listBooks();

unset($library);

?>
    </h1>
</body>
</html>
