<?php
require_once 'auxiliar.php';

class Cliente
{
    public $id;
    public $dni;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $codpostal;
    public $telefono;

    public static PDO $pdo;
    public static function buscar_por_id($id): ?Cliente
    {
        $pdo = Cliente::pdo();
        $sent = $pdo->prepare('SELECT * FROM clientes WHERE id = :id');
        $sent->execute([':id' => $id]);
        return $sent->fetchObject(Cliente::class) ?: null;

    }

    public static function borrar_por_id(String|int $id): void
    {
        Cliente::buscar_por_id($id)?->borrar();
    }

    /**
     * Devuelve todos los clientes.
     * 
     *  @return Cliente[]
     */



    
    public static function todos(): array
    {
        $pdo = Cliente::pdo();
        $sent = $pdo->query('SELECT * FROM clientes');
        return $sent->fetchALL(PDO::FETCH_CLASS, Cliente::class);
        
    }


    public function borrar(): void
    {
        $pdo = Cliente::pdo();
        $sent = $pdo->prepare("DELETE FROM clientes WHERE id = :id"); /* el :id es un marcador */
        $sent->execute([':id' => $this->id]);
    }

    private static function pdo(): PDO
    {    
    Cliente::$pdo = Cliente::$pdo ?? conectar();
        return Cliente::$pdo;
    }
}