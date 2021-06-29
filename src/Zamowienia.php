<?php

namespace Ibd;

class Zamowienia
{
    /**
     * Instancja klasy obsługującej połączenie do bazy.
     *
     * @var Db
     */
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * Dodaje zamówienie.
     * 
     * @param int $idUzytkownika
     * @return int Id zamówienia
     */
    public function dodaj(int $idUzytkownika): int
    {
        return $this->db->dodaj('zamowienia', [
            'id_uzytkownika' => $idUzytkownika,
            'id_statusu' => 1
        ]);
    }

    /**
     * Dodaje szczegóły zamówienia.
     * 
     * @param int   $idZamowienia
     * @param array $dane Książki do zamówienia
     */
    public function dodajSzczegoly(int $idZamowienia, array $dane): void
    {
        foreach ($dane as $ksiazka) {
            $this->db->dodaj('zamowienia_szczegoly', [
                'id_zamowienia' => $idZamowienia,
                'id_ksiazki' => $ksiazka['id'],
                'cena' => $ksiazka['cena'],
                'liczba_sztuk' => $ksiazka['liczba_sztuk']
            ]);
        }
    }

    /**
     * Pobiera wszystkie zamówienia.
     *
     * @return array
     */
    public function pobierzWszystkie(): array
    {
        $sql = "
			SELECT z.*, u.login, s.nazwa AS status,
			ROUND(SUM(zs.cena*zs.liczba_sztuk), 2) AS suma,
			COUNT(zs.id) AS liczba_produktow,
			SUM(zs.liczba_sztuk) AS liczba_sztuk
			FROM zamowienia z 
			JOIN uzytkownicy u ON z.id_uzytkownika = u.id
			JOIN zamowienia_statusy s ON z.id_statusu = s.id
			JOIN zamowienia_szczegoly zs ON z.id = zs.id_zamowienia
			GROUP BY z.id
	    ";

        return $this->db->pobierzWszystko($sql);
    }
    public function pobierzWszystkieUsera(string $idUzytkownika): array
    {
        $sql = "SELECT * FROM zamowienia z 
                JOIN zamowienia_szczegoly AS zs ON z.id = zs.id_zamowienia
                JOIN ksiazki AS k ON zs.id_ksiazki = k.id
                WHERE id_uzytkownika = '$idUzytkownika'";

        return $this->db->pobierzWszystko($sql);
    }

    public function pobierzZamowienie(string $idZamowienia): array
    {
        $sql = "SELECT zs.*, k.zdjecie, k.id_autora, a.id, k.tytul, CONCAT(a.imie, ' ', a.nazwisko) AS autor, u.login,
                z.data_dodania, s.nazwa as status
                FROM zamowienia z 
                JOIN zamowienia_szczegoly AS zs ON z.id = zs.id_zamowienia
                JOIN uzytkownicy AS u ON z.id_uzytkownika = u.id
                JOIN ksiazki AS k ON zs.id_ksiazki = k.id
                JOIN autorzy AS a ON a.id = k.id_autora
                JOIN zamowienia_statusy s ON z.id_statusu = s.id
                WHERE zs.id_zamowienia = '$idZamowienia'";

        return $this->db->pobierzWszystko($sql);
    }

    public function pobierzStatusy(): array{
        $sql = "SELECT * FROM zamowienia_statusy";
        return $this->db->pobierzWszystko($sql);
    }

    public function edytuj(array $dane, int $id): bool
    {
        $update = [
            'id_statusu' => $dane['status'],
        ];
        return $this->db->aktualizuj('zamowienia', $update, $id);
    }

    public function pobierz(int $id): ?array
    {
        return $this->db->pobierz('zamowienia', $id);
    }

}
