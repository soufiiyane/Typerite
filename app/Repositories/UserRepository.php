<?php

Use PHPMailer\PHPMailer\PHPMailer;
Use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';
require_once 'app/Contracts/UserRepositoryInterface.php';
require_once 'app/Classes/BDConnection.php';
require_once 'app/Classes/User.php';

class UserRepository implements UserRepositoryInterface
{

    private PDO $db;

    public function __construct()
    {
        $this->db = BDConnection::getInstance()->getConnection();
    }

    public function getAllUsers(): array
    {
        $query = $this->db->prepare(/** @lang text */ 'select * from user');
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
        $query = $this->db->prepare(/** @lang text */"select * from user where 
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

    // try catch handler (to-do)
    public function saveUser(User $user): bool
    {
        $query = $this->db->prepare(/** @lang text */'insert into user(name, lastname,
        email, password, role, imagepath, token) values(?, ?, ?, ?, ?, ?, ?)');
        $name = $user->getName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $role = $user->getRole();
        $imagepath = $user->getImagePath();
        $token = bin2hex( random_bytes(32));
        $query->bindParam(1, $name);
        $query->bindParam(2, $lastName);
        $query->bindParam(3, $email);
        $query->bindParam(4, $password);
        $query->bindParam(5, $role);
        $query->bindParam(6, $imagepath);
        $query->bindParam(7, $token);
        if ($query->execute()) {
            $phpmailer = new PHPMailer(true);

            // MY SMTP CONFIGURATION IN MAILTRAP
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'fbde8731088316';
            $phpmailer->Password = 'b99499c110d04f';
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $phpmailer->setFrom('typerite@gmail.com','Typerite');
            $phpmailer->addAddress($user->getEmail(),$user->getName().' '.$user->getLastName());
            $phpmailer->isHTML(true);
            $phpmailer->Subject = 'Account Verification';
            $phpmailer->Body = file_get_contents('includes/emailTemplate.html');
            $url = "http://localhost/projects/Typerite/Verify.php?token=$token";
            $phpmailer->Body = str_replace(
                array('[Link]'),
                array($url),
                $phpmailer->Body
            );
            if ($phpmailer->send()) {

                return true;
            }
            echo 'Error email sending' . $phpmailer->ErrorInfo;

            return false;
        }

        return false;
    }

    // UNFINISHED TO DO
    public function verifyEmail(string $token): bool
    {
        $query = $this->db->prepare(/** @lang text */'select * from user where 
        token = ?');
        $query->bindParam(1,$token);
        $query->execute();
        $user = $query->fetchObject();
        if (!$user) {
            // Token not found or user already verified

            return false;
        }
        // Update the user's record to mark them as verified
        $query = $this->db->prepare(/** @lang text */'update user set is_verified =
        ?,token = ?, id = ?');
        $verified = true;
        $token = '';
        $query->bindParam(1, $verified);
        $query->bindParam(2,$token);
        $query->bindParam(3,$user->id);
        $query->execute();

        return true;
    }

    public function deleteUserById(int $id): bool
    {
        $query = $this->db->prepare(/** @lang text */'delete from user where id = ?');
        $query->bindParam(1,$id);
        if ($query->execute()) {

            return true;
        }

        return false;
    }

}