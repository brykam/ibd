<?php

namespace Ibd;

class Autorzy
{
	private Db $db;

	public function __construct()
	{
		$this->db = new Db();
	}

	/**
	 * Pobiera zapytanie SELECT z autorami.
	 *
	 * @return string
     */
	public function pobierzSelect(): string
    {
        return "SELECT * FROM autorzy WHERE 1=1 ";
	}

	/**
	 * Wykonuje podane w parametrze zapytanie SELECT.
	 * 
	 * @param string $select
	 * @return array
	 */
	public function pobierzWszystko(string $select): array
    {
		return $this->db->pobierzWszystko($select);
	}

	/**
	 * Pobiera dane autora o podanym id.
	 * 
	 * @param int $id
	 * @return array
	 */
	public function pobierz(int $id): array
    {
		return $this->db->pobierz('autorzy', $id);
	}

	/**
	 * Dodaje autora.
	 *
	 * @param array $dane
	 * @return int
	 */
	public function dodaj(array $dane): int
    {
		return $this->db->dodaj('autorzy', [
			'imie' => $dane['imie'],
			'nazwisko' => $dane['nazwisko']
		]);
	}

	/**
	 * Usuwa autora.
	 * 
	 * @param int $id
	 * @return bool
	 */
	public function usun(int $id): bool
    {
		return $this->db->usun('autorzy', $id);
	}

	/**
	 * Zmienia dane autora.
	 * 
	 * @param array $dane
	 * @param int   $id
	 * @return bool
	 */
	public function edytuj(array $dane, int $id): bool
    {
		$update = [
			'imie' => $dane['imie'],
			'nazwisko' => $dane['nazwisko']
		];
		
		return $this->db->aktualizuj('autorzy', $update, $id);
	}

    public function pobierzZapytanie(array $params = []): array
    {
        $parametry = [];
        $sql = "SELECT autorzy.imie, autorzy.nazwisko, autorzy.id 
                FROM autorzy 
                WHERE 1=1 ";

        // dodawanie warunków do zapytanie
        if (!empty($params['fraza'])) {
            $sql .= "AND (
                     autorzy.nazwisko LIKE :fraza OR
                     autorzy.imie LIKE :fraza
                     ) ";
            $parametry['fraza'] = "%$params[fraza]%";
        }

        // dodawanie sortowania
        if (!empty($params['sortowanie'])) {
            $kolumny = ['autorzy.nazwisko'];
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
       $select = "SELECT id_autora, count(*) as liczba_ksiazek FROM ksiazki WHERE id_autora = '$id' GROUP BY id_autora";
        return $this->db->pobierzWszystko($select);
    }

}
