<?php

namespace Ibd;

class Ksiazki
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
     * Pobiera wszystkie książki.
     *
     * @return array
     */
    public function pobierzWszystkie(): ?array
    {
		$sql = "SELECT k.*, autorzy.imie, autorzy.nazwisko, kategorie.nazwa as kategoria 
                FROM ksiazki k 
                JOIN autorzy ON k.id_autora=autorzy.id 
                JOIN kategorie ON k.id_kategorii=kategorie.id";

        return $this->db->pobierzWszystko($sql);
    }

    /**
     * Pobiera dane książki o podanym id.
     *
     * @param int $id
     * @return array
     */
    public function pobierz(int $id): ?array
    {
        return $this->db->pobierz('ksiazki', $id);
    }


	/**
	 * Pobiera najlepiej sprzedające się książki.
	 *
	 */
	public function pobierzBestsellery(): ?array
	{
		$sql = "SELECT k.*, autorzy.nazwisko, autorzy.imie FROM ksiazki k JOIN autorzy ON k.id_autora=autorzy.id ORDER BY RAND() LIMIT 5";

        return $this->db->pobierzWszystko($sql);
	}

    /**
     * Pobiera zapytanie SELECT oraz jego parametry;
     *
     * @param array $params
     * @return array
     */
    public function pobierzZapytanie(array $params = []): array
    {
        $parametry = [];
        $sql = "SELECT k.*, autorzy.imie, autorzy.nazwisko, kategorie.nazwa as kategoria 
                FROM ksiazki k 
                JOIN autorzy ON k.id_autora=autorzy.id 
                JOIN kategorie ON k.id_kategorii=kategorie.id 
                WHERE 1=1 ";

        // dodawanie warunków do zapytanie
        if (!empty($params['fraza'])) {
            $sql .= "AND (k.tytul LIKE :fraza OR 
                     autorzy.nazwisko LIKE :fraza OR
                     autorzy.imie LIKE :fraza OR
                     k.opis LIKE :fraza) ";
            $parametry['fraza'] = "%$params[fraza]%";
        }
        if (!empty($params['id_kategorii'])) {
            $sql .= "AND k.id_kategorii = :id_kategorii ";
            $parametry['id_kategorii'] = $params['id_kategorii'];
        }

        // dodawanie sortowania
        if (!empty($params['sortowanie'])) {
            $kolumny = ['k.tytul', 'k.cena', 'autorzy.nazwisko'];
            $kierunki = ['ASC', 'DESC'];
            [$kolumna, $kierunek] = explode(' ', $params['sortowanie']);

            if (in_array($kolumna, $kolumny) && in_array($kierunek, $kierunki)) {
                $sql .= " ORDER BY " . $params['sortowanie'];
            }
        }
        return ['sql' => $sql, 'parametry' => $parametry];
    }

    /**
     * Pobiera stronę z danymi książek.
     *
     * @param string $select
     * @param array  $params
     * @return array
     */
    public function pobierzStrone(string $select, array $params = []): array
    {
        return $this->db->pobierzWszystko($select, $params);
    }
}
