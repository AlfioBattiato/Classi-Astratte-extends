<?php

// Definizione dell'interfaccia Prestito
interface Prestito {
    public function prestare();
    public function restituire();
}

// Definizione della classe astratta MaterialeBibliotecario
abstract class MaterialeBibliotecario implements Prestito {
    // Attributo statico per contare il numero di materiali
    protected static $contatoreMateriali = 0;

    // Attributi comuni per tutti i materiali bibliotecari
    protected $titolo;
    protected $autore;

    // Costruttore
    public function __construct($titolo, $autore) {
        $this->titolo = $titolo;
        $this->autore = $autore;
        self::$contatoreMateriali++;
    }

    // Metodo statico per ottenere il numero totale di materiali
    public static function getContatoreMateriali() {
        return self::$contatoreMateriali;
    }

    // Metodi astratti per l'interfaccia Prestito
    abstract public function prestare();
    abstract public function restituire();
}

// Definizione della sottoclasse Libro
class Libro extends MaterialeBibliotecario {
    private $numeroPagine;

    public function __construct($titolo, $autore, $numeroPagine) {
        parent::__construct($titolo, $autore);
        $this->numeroPagine = $numeroPagine;
    }

    public function prestare() {
        echo "Il libro '$this->titolo' è stato prestato.\n";
    }

    public function restituire() {
        echo "Il libro '$this->titolo' è stato restituito.\n";
    }
}

// Definizione della sottoclasse DVD
class DVD extends MaterialeBibliotecario {
    private $durata;

    public function __construct($titolo, $autore, $durata) {
        parent::__construct($titolo, $autore);
        $this->durata = $durata;
    }

    public function prestare() {
        echo "Il DVD '$this->titolo' è stato prestato.\n";
    }

    public function restituire() {
        echo "Il DVD '$this->titolo' è stato restituito.\n";
    }
}
$libro1 = new Libro("Il Signore degli Anelli", "J.R.R. Tolkien", 1200);
$dvd1 = new DVD("Il Padrino", "Francis Ford Coppola", 175);

$libro1->prestare();
$libro1->restituire();

$dvd1->prestare();
$dvd1->restituire();

echo "Numero totale di materiali nella biblioteca: " . MaterialeBibliotecario::getContatoreMateriali() . "\n";


