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
     * @return array Tablica z danymi, false jeśl nie udało się wysłać zapytania
     */
    public function pobierzWszystko(string $sql, ?array $params = null): ?array
    {
        $stmt = $this->pdo->prepare($sql);

        if (!empty($params) && is_array($params)) {
            foreach ($params as $k => $v)
                $stmt->bindParam($k, $v);
        }

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : null;
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
}
