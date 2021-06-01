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

}
