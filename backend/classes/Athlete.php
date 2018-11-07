<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 11/7/2018
     * Time: 11:15 PM
     */

    namespace rperv;


    class Athlete implements \JsonSerializable {
        private $pdo;
        private $firstname, $lastname;
        private $gender, $title, $birthday;
        private $aID, $clubID;

        /**
         * Athlete constructor.
         *
         * @param int    $aID
         * @param string $firstname
         * @param string $lastname
         * @param string $gender
         * @param string $title
         * @param date   $birthday
         * @param int    $clubID
         */
        public function __construct($aID, $firstname, $lastname, $gender, $title, $birthday, $clubID) {
            $this->pdo = new PDO_MYSQL();
            $this->aID = $aID;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->gender = $gender;
            $this->title = $title;
            $this->birthday = $birthday;
            $this->clubID = $clubID;
        }

        /**
         * creates a new instance from a specific uID using dataO from db
         *
         * @param int $aID
         * @return Athlete
         */
        public static function fromAID($aID) {
            $pdo = new PDO_MYSQL();
            $res = $pdo->query("SELECT * FROM rperv_athletes WHERE aID = :aid", [":aid" => $aID]);
            return new Athlete($res->aID, $res->firstname, $res->lastname, $res->gender, $res->title, $res->birthday, $res->clubID);
        }


        /**
         * Deletes a athlete
         *
         * @return bool
         */
        public function delete() {
            return $this->pdo->query("DELETE FROM rperv_athletes WHERE aID = :aid", [":aid" => $this->aID]);
        }

        /**
         * Saves the Changes made to this object to the db
         */
        public function saveChanges() {
            $this->pdo->queryUpdate("rperv_athletes",
                ["firstname" => $this->firstname,
                 "lastname" => $this->lastname,
                 "gender" => $this->gender,
                 "title" => $this->title,
                 "birthday" => $this->birthday,
                 "clubID" => $this->clubID],
                "aID = :aid",
                ["aid" => $this->aID]
            );
        }

        /**
         * Creates a new athlete from the give attribs
         *
         * @param $firstname
         * @param $lastname
         * @param $gender
         * @param $title
         * @param $birthday
         * @param $clubID
         */
        public static function create($firstname, $lastname, $gender, $title, $birthday, $clubID) {
            $pdo = new PDO_MYSQL();
            $pdo->queryInsert("rperv_athletes",
                ["firstname" => $firstname,
                 "lastname" => $lastname,
                 "gender" => $gender,
                 "title" => $title,
                 "birthday" => $birthday,
                 "clubID" => $clubID]
            );
        }


        /**
         * @return mixed
         */
        public function getFirstname() {
            return $this->firstname;
        }

        /**
         * @param mixed $firstname
         */
        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        /**
         * @return mixed
         */
        public function getLastname() {
            return $this->lastname;
        }

        /**
         * @param mixed $lastname
         */
        public function setLastname($lastname) {
            $this->lastname = $lastname;
        }

        /**
         * @return mixed
         */
        public function getGender() {
            return $this->gender;
        }

        /**
         * @param mixed $gender
         */
        public function setGender($gender) {
            $this->gender = $gender;
        }

        /**
         * @return mixed
         */
        public function getTitle() {
            return $this->title;
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title) {
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getBirthday() {
            return $this->birthday;
        }

        /**
         * @param mixed $birthday
         */
        public function setBirthday($birthday) {
            $this->birthday = $birthday;
        }

        /**
         * @return int
         */
        public function getAID() {
            return $this->aID;
        }

        /**
         * @param int $aID
         */
        public function setAID($aID) {
            $this->aID = $aID;
        }

        /**
         * @return int
         */
        public function getClubID() {
            return $this->clubID;
        }

        /**
         * @param int $clubID
         */
        public function setClubID($clubID) {
            $this->clubID = $clubID;
        }

        /**
         * Specify data which should be serialized to JSON
         *
         * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
         * @return mixed data which can be serialized by <b>json_encode</b>,
         * which is a value of any type other than a resource.
         * @since 5.4.0
         */
        public function jsonSerialize() {
            return [
                "aID" => $this->aID,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "gender" => $this->gender,
                "title" => $this->title,
                "birthday" => $this->birthday,
                "clubID" => Club::fromClubID($this->clubID)
            ];
        }
    }