<?php
class RestoTable
{

    private PDO $myPdo;


    public function __construct()
    {
        $this->myPdo = DbConnect::getInstance();
    }

    public function afficherRestaurants(): array
    {
        $rq = "select * from restaurants";
        $data = [];

        $statement = $this->myPdo->query($rq);

        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {

            array_push($data, $row);
        }
        return $data;
    }
    public function rechercherResto($_name): array
    {
        $rq = "select * from restaurants where soundex(nom) = soundex(:_name) ";
        $statement = $this->myPdo->prepare($rq);
        $statement->bindParam(":_name", $_name, PDO::PARAM_STR);
        $statement->execute();
        $data = [];
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {

            array_push($data, $row);
        }
        return $data;
    }

    public function searchOne($_id): array
    {
        $rq = "select * from restaurants where id = :_id ";
        $statement = $this->myPdo->prepare($rq);
        $statement->bindParam(":_id", $_id, PDO::PARAM_INT);
        $statement->execute();
        $data = [];
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {

            array_push($data, $row);
        }
        return $data;
    }
    private function filterString(string $_chaine): string
    {
        $chaine = trim($_chaine);
        $chaine = htmlspecialchars($chaine);
        $chaine = strip_tags($chaine);
        return $chaine;
    }

    public function upDateRow(string $_nom, string $_adresse, float $_prix, string $_commentaire, float $_note, string $_maDate, int $_id): int
    {

        $nom = $this->filterString($_nom);
        $adresse = $this->filterString($_adresse);
        $commentaire = $this->filterString($_commentaire);
        $rq = "update restaurants set nom=?,adresse=?,prix=?,commentaire=?, note=?,visite=? where id=?";
        $pdoStatement = $this->myPdo->prepare($rq);
        $pdoStatement->execute([$nom, $adresse, floatval($_prix), $commentaire, floatval($_note), $_maDate, $_id]);
        $nbLigne =  $pdoStatement->rowCount();

        return $nbLigne;
    }

    public function ajouterResteau(string $_nom, string $_adresse, float $_prix, string $_commentaire, int $_note, string $_visite): bool 
    {                                                                                                                                        
           $rq= "insert into restaurants values (id, ?, ?, ?, ?, ?, ?) ";
           $pdoStatement=$this->myPdo->prepare($rq);
           $pdoStatement->execute([$_nom, $_adresse, $_prix, $_commentaire, $_note, $_visite ]); 
            $nbLigne = $pdoStatement->rowCount();

             $succes= false;

             if ($nbLigne===1) {
                $succes=true;
             }

             return $succes;
    }                                                                                                
public function deleteRestau(int $_id):int{
    $rq="delete from restaurants where id=:id";
    $pdoStatement=$this->myPdo->prepare($rq);
    $pdoStatement->bindParam(":id",$_id,PDO::PARAM_INT); // Lier une variable a la requete definis son type.
    $pdoStatement->execute();
    $nbLigne=$pdoStatement->rowCount();

    return $nbLigne;

}
}
