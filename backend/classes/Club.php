<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 11/7/2018
     * Time: 11:06 PM
     */

    namespace rperv;


    class Club implements \JsonSerializable {
        private $pdo;
        private $clubID, $clubCity;
        private $clubName, $clubNameShort;

        /**
         * Club constructor.
         *
         * @param $clubID
         * @param $clubCity
         * @param $clubName
         * @param $clubNameShort
         */
        public function __construct($clubID, $clubCity, $clubName, $clubNameShort) {
            $this->pdo = new PDO_MYSQL();
            $this->clubID = $clubID;
            $this->clubCity = $clubCity;
            $this->clubName = $clubName;
            $this->clubNameShort = $clubNameShort;
        }

        /**
         * creates a new instance from a specific uID using dataO from db
         *
         * @param int $clubID
         * @return Club
         */
        public static function fromClubID($clubID) {
            $pdo = new PDO_MYSQL();
            $res = $pdo->query("SELECT * FROM rperv_clubs WHERE clubID = :cid", [":cid" => $clubID]);
            return new Club($res->clubID, $res->clubCity, $res->clubName, $res->clubNameShort);
        }


        /**
         * Deletes a user
         *
         * @return bool
         */
        public function delete() {
            return $this->pdo->query("DELETE FROM rperv_clubs WHERE clubID = :cid", [":cid" => $this->clubID]);
        }

        /**
         * Saves the Changes made to this object to the db
         */
        public function saveChanges() {
            $this->pdo->queryUpdate("rperv_club",
                ["clubName" => $this->clubName,
                 "clubNameShort" => $this->clubNameShort,
                 "clubCity" => $this->clubCity],
                "clubID = :cid",
                ["cid" => $this->clubID]
            );
        }

        /**
         * Creates a new user from the give attribs
         *
         * @param string $clubName
         * @param string $clubNameShort
         * @param string $clubCity
         */
        public static function create($clubName, $clubNameShort, $clubCity) {
            $pdo = new PDO_MYSQL();
            $pdo->queryInsert("rperv_user",
                ["clubName" => $clubName,
                 "clubNameShort" => $clubNameShort,
                 "clubCity" => $clubCity]
            );
        }

        /**
         * @return mixed
         */
        public function getClubID() {
            return $this->clubID;
        }

        /**
         * @param mixed $clubID
         */
        public function setClubID($clubID) {
            $this->clubID = $clubID;
        }

        /**
         * @return mixed
         */
        public function getClubCity() {
            return $this->clubCity;
        }

        /**
         * @param mixed $clubCity
         */
        public function setClubCity($clubCity) {
            $this->clubCity = $clubCity;
        }

        /**
         * @return mixed
         */
        public function getClubName() {
            return $this->clubName;
        }

        /**
         * @param mixed $clubName
         */
        public function setClubName($clubName) {
            $this->clubName = $clubName;
        }

        /**
         * @return mixed
         */
        public function getClubNameShort() {
            return $this->clubNameShort;
        }

        /**
         * @param mixed $clubNameShort
         */
        public function setClubNameShort($clubNameShort) {
            $this->clubNameShort = $clubNameShort;
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
                "clubID" => $this->clubID,
                "clubName" => $this->clubName,
                "clubNameShort" => $this->clubNameShort,
                "clubCity" => $this->clubCity
            ];
        }
    }