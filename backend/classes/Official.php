<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 11/7/2018
     * Time: 11:24 PM
     */

    namespace rperv;


    class Official {
        private $pdo;
        private $firstname, $lastname;
        private $gender, $title, $birthday, $function;
        private $oID, $clubID;

        /**
         * Official constructor.
         *
         * @param int    $oID
         * @param string $firstname
         * @param string $lastname
         * @param string $gender
         * @param string $title
         * @param string $function
         * @param date   $birthday
         * @param int    $clubID
         */
        public function __construct($oID, $firstname, $lastname, $gender, $title, $function, $birthday, $clubID) {
            $this->pdo = new PDO_MYSQL();
            $this->oID = $oID;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->gender = $gender;
            $this->title = $title;
            $this->birthday = $birthday;
            $this->function = $function;
            $this->clubID = $clubID;
        }

        /**
         * creates a new instance from a specific uID using dataO from db
         *
         * @param int $oID
         * @return Official
         */
        public static function fromAID($oID) {
            $pdo = new PDO_MYSQL();
            $res = $pdo->query("SELECT * FROM rperv_officials WHERE oID = :oid", [":oid" => $oID]);
            return new Official($res->oID, $res->firstname, $res->lastname, $res->gender, $res->title, $res->function, $res->birthday, $res->clubID);
        }


        /**
         * Deletes a athlete
         *
         * @return bool
         */
        public function delete() {
            return $this->pdo->query("DELETE FROM rperv_officials WHERE oID = :oid", [":oid" => $this->oID]);
        }

        /**
         * Saves the Changes made to this object to the db
         */
        public function saveChanges() {
            $this->pdo->queryUpdate("rperv_officials",
                ["firstname" => $this->firstname,
                 "lastname" => $this->lastname,
                 "gender" => $this->gender,
                 "title" => $this->title,
                 "birthday" => $this->birthday,
                 "fnct" => $this->function,
                 "clubID" => $this->clubID],
                "oID = :oid",
                ["oid" => $this->oID]
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
        public static function create($firstname, $lastname, $gender, $title, $function, $birthday, $clubID) {
            $pdo = new PDO_MYSQL();
            $pdo->queryInsert("rperv_officials",
                ["firstname" => $firstname,
                 "lastname" => $lastname,
                 "gender" => $gender,
                 "title" => $title,
                 "birthday" => $birthday,
                 "function" => $function,
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
         * @return mixed
         */
        public function getFunction() {
            return $this->function;
        }

        /**
         * @param mixed $function
         */
        public function setFunction($function) {
            $this->function = $function;
        }

        /**
         * @return int
         */
        public function getOID() {
            return $this->oID;
        }

        /**
         * @param int $oID
         */
        public function setOID($oID) {
            $this->oID = $oID;
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
                "oID" => $this->oID,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "gender" => $this->gender,
                "title" => $this->title,
                "birthday" => $this->birthday,
                "function" => $this->function,
                "clubID" => Club::fromClubID($this->clubID)
            ];
        }
    }