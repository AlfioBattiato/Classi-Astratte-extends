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
    protected $disponibile;

    // Costruttore
    public function __construct($titolo, $autore) {
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->disponibile = true;
        self::$contatoreMateriali++;
    }

    // Metodo statico per ottenere il numero totale di materiali
    public static function getContatoreMateriali() {
        return self::$contatoreMateriali;
    }

    // Metodo per prestare il materiale
    public function prestare() {
        if ($this->disponibile) {
            $this->disponibile = false;
            echo "Il materiale '$this->titolo' è stato prestato.\n";
        } else {
            echo "Il materiale '$this->titolo' non è disponibile per il prestito.\n";
        }
    }

    // Metodo per restituire il materiale
    public function restituire() {
        if (!$this->disponibile) {
            $this->disponibile = true;
            echo "Il materiale '$this->titolo' è stato restituito.\n";
        } else {
            echo "Il materiale '$this->titolo' non era in prestito.\n";
        }
    }

    // Metodi astratti per l'interfaccia Prestito
    abstract public static function contaLibri();
    abstract public static function contaDVD();
}

// Definizione della sottoclasse Libro
class Libro extends MaterialeBibliotecario {
    private static $contatoreLibri = 0;
    private $numeroPagine;

    public function __construct($titolo, $autore, $numeroPagine) {
        parent::__construct($titolo, $autore);
        $this->numeroPagine = $numeroPagine;
        self::$contatoreLibri++;
    }

    // Metodo statico per contare i libri
    public static function contaLibri() {
        return self::$contatoreLibri;
    }

    // Metodo statico per contare i DVD (per interfaccia, restituisce 0)
    public static function contaDVD() {
        return 0;
    }
}

// Definizione della sottoclasse DVD
class DVD extends MaterialeBibliotecario {
    private static $contatoreDVD = 0;
    private $durata;

    public function __construct($titolo, $autore, $durata) {
        parent::__construct($titolo, $autore);
        $this->durata = $durata;
        self::$contatoreDVD++;
    }

    // Metodo statico per contare i DVD
    public static function contaDVD() {
        return self::$contatoreDVD;
    }

    // Metodo statico per contare i libri (per interfaccia, restituisce 0)
    public static function contaLibri() {
        return 0;
    }
}

$libro1 = new Libro("Il Signore degli Anelli", "J.R.R. Tolkien", 1200);
$libro2 = new Libro("1984", "George Orwell", 328);
$dvd1 = new DVD("Il Padrino", "Francis Ford Coppola", 175);
$dvd2 = new DVD("Inception", "Christopher Nolan", 148);

$libro1->prestare();
$libro1->restituire();
$libro2->prestare();
$dvd1->prestare();
$dvd1->restituire();
$dvd2->prestare();

echo "Numero totale di materiali nella biblioteca: " . MaterialeBibliotecario::getContatoreMateriali() . "\n";
echo "Numero totale di libri nella biblioteca: " . Libro::contaLibri() . "\n";
echo "Numero totale di DVD nella biblioteca: " . DVD::contaDVD() . "\n";

?>
