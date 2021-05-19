<?php

namespace Ibd;

/**
 * Klasa obsługująca połączenie z bazą danych MySQL.
 *
 */
class Db
{
    /**
     * Dane dostępowe do bazy.
     */
    private string $dbLogin = 'root';
    private string $dbPassword = '';
    private string $dbHost = 'localhost';
    private string $dbName = 'ibd';

    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbLogin, $this->dbPassword);
        $this->pdo->query("SET NAMES utf8");
    }

    /**
     * Wykonuje podane zapytanie i zwraca wynik w postaci talicy.
     *
     * @param            $sql    string Zapytanie SQL
     * @param array|null $params Tablica z parametrami zapytania
     * @return array Tablica z danymi
     */
    public function pobierzWszystko(string $sql, ?array $params = null): array
    {
        $stmt = $this->pdo->prepare($sql);

        if (!empty($params) && is_array($params)) {
            foreach ($params as $k => $v)
                $stmt->bindParam($k, $v);
        }

        if (!$stmt->execute()) {
            throw new \RuntimeException("Failed to execute [$sql] {$stmt->errorInfo()[2]}");
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Pobiera rekord o podanym ID z wybranej tabeli.
     *
     * @param string  $table
     * @param integer $id
     * @return array
     */
    public function pobierz(string $table, int $id): ?array
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id]) ? $stmt->fetch(\PDO::FETCH_ASSOC) : null;
    }

    /**
     * Liczy rekordy zwrócone przez zapytanie.
     *
     * @param string $sql
     * @param array  $params
     * @return int
     */
    public function policzRekordy(string $sql, array $params = []): int
    {
        $stmt = $this->pdo->prepare($sql);

        if (!empty($params) && is_array($params)) {
            foreach($params as $k => $v) {
                $stmt->bindParam($k, $v);
            }
        }
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Dodaje rekord o podanych parametrach do wybranej tabeli.
     *
     * @param string $tabela
     * @param array  $params
     * @return int
     */
    public function dodaj(string $tabela, array $params): int
    {
        $klucze = array_keys($params);
        $sql = "INSERT INTO $tabela (";
        $sql .= implode(', ', $klucze);
        $sql .= ") VALUES (";

        array_walk($klucze, function(&$elem, $klucz) {
            $elem = ":$elem";
        });
        $sql .= implode(', ', $klucze);
        $sql .= ")";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $this->pdo->lastInsertId();
    }

    /**
     * Usuwa rekord o podanym id z wybranej tabeli.
     *
     * @param string $tabela
     * @param int    $id
     * @return bool
     */
    public function usun(string $tabela, int $id): bool
    {
        $sql = "DELETE FROM $tabela WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    /**
     * Aktualizuje rekord w wybranej tabeli o podanym id.
     *
     * @param string $tabela
     * @param array  $params
     * @param int    $id
     * @return bool
     */
    public function aktualizuj(string $tabela, array $params, int $id): bool
    {
        $sql = "UPDATE $tabela SET ";
        foreach ($params as $k => $v) {
            $sql .= "$k = :$k, ";
        }

        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $params['id'] = $id;
        return $stmt->execute($params);
    }
}
