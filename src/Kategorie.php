<?php

namespace Ibd;

class Kategorie
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
     * Pobiera wszystkie kategorie.
     *
     * @return array
     */
    public function pobierzWszystkie(): array
    {
        $sql = "SELECT * FROM kategorie";

        return $this->db->pobierzWszystko($sql);
    }

    public function pobierz(int $id): array
    {
        return $this->db->pobierz('kategorie', $id);
    }

    public function dodaj(array $dane): int
    {
        return $this->db->dodaj('kategorie', [
            'nazwa' => $dane['kategoria']
        ]);
    }

    /**
     * Usuwa kategorie.
     *
     * @param int $id
     * @return bool
     */
    public function usun(int $id): bool
    {
        return $this->db->usun('kategorie', $id);
    }

    /**
     * Zmienia dane kategorie.
     *
     * @param array $dane
     * @param int   $id
     * @return bool
     */
    public function edytuj(array $dane, int $id): bool
    {
        $update = [
            'nazwa' => $dane['kategoria']
        ];

        return $this->db->aktualizuj('kategorie', $update, $id);
    }



    public function pobierzZapytanie(array $params = []): array
    {
        $parametry = [];
        $sql = "SELECT kategorie.nazwa, kategorie.id 
                FROM kategorie 
                WHERE 1=1 ";

        // dodawanie warunków do zapytanie
        if (!empty($params['fraza'])) {
            $sql .= "AND (
                     kategorie.nazwa LIKE :fraza
                     ) ";
            $parametry['fraza'] = "%$params[fraza]%";
        }

        // dodawanie sortowania
        if (!empty($params['sortowanie'])) {
            $kolumny = ['kategorie.nazwa'];
            $kierunki = ['ASC', 'DESC'];
            [$kolumna, $kierunek] = explode(' ', $params['sortowanie']);

            if (in_array($kolumna, $kolumny) && in_array($kierunek, $kierunki)) {
                $sql .= " ORDER BY " . $params['sortowanie'];
            }
        }
        return ['sql' => $sql, 'parametry' => $parametry];
    }

    public function pobierzStrone(string $select, array $params = []): array
    {
        return $this->db->pobierzWszystko($select, $params);
    }

    public function pobierzLiczbeKsiazek(int $id): array
    {
        $select = "SELECT id_kategorii, count(*) as liczba_ksiazek FROM ksiazki WHERE id_kategorii = '$id' GROUP BY id_kategorii";
        return $this->db->pobierzWszystko($select);
    }

}
