<?php

require_once 'app/Contracts/UserRepositoryInterface.php';
require_once 'app/Classes/BDConnection.php';
require_once 'app/Classes/User.php';

class UserRepository implements UserRepositoryInterface
{
    private BDConnection $connection;

    public function __construct()
    {
        $this->connection = BDConnection::getInstance();
    }

    public function getAllUsers(): array
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */ 'select * from user');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        $whereClause = "";
        $values = [];
        foreach ($criteria as $column => $value) {
            $whereClause .= "$column = ? AND ";
            $values[] = $value;
        }
        $whereClause = rtrim($whereClause, "AND ");
        $orderByClause = "";
        if ($orderBy !== null) {
            $orderByClause = "ORDER BY ";
            foreach ($orderBy as $column => $direction) {
                $orderByClause .= "$column $direction, ";
            }
            $orderByClause = rtrim($orderByClause, ", ");
        }
        $query = $this->connection->getConnection()->prepare(/** @lang text */"select * from user where 
        $whereClause $orderByClause limit 1");
        $query->execute($values);
        if ($query->rowCount()>0) {
            $query = $query->fetchObject();
            $user = new User();
            $user->setId($query->id);
            $user->setName($query->name);
            $user->setLastName($query->lastname);
            $user->setEmail($query->email);
            $user->setPassword($query->password);
            $user->setRole($query->role);
            $user->setImagePath($query->imagepath);
            $user->setCreatedAt($query->createdat);

            return $user;
        }

        return null;
    }

    public function saveUser(User $user): void
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */'insert into user(name,lastname,
        email,password,role,imagepath) values(?,?,?,?,?,?)');
        $name = $user->getName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $role = $user->getRole();
        $imagepath = $user->getImagePath();
        $query->bindParam(1, $name);
        $query->bindParam(2, $lastName);
        $query->bindParam(3, $email);
        $query->bindParam(4, $password);
        $query->bindParam(5, $role);
        $query->bindParam(6, $imagepath);
        $query->execute();
    }

    public function deleteUserById(int $id): void
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */'delete from user where id = ?');
        $query->bindParam(1,$id);
        $query->execute();
    }

}