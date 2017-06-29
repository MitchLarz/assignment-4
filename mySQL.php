<?php
// database functions ************************************************
include "../dbConnect.php";

function fInsertToDatabase($asin, $title, $price) {
    $myDB = fConnectToDatabase();
    $sql = "INSERT INTO dvdtitles (asin, title, price) VALUES ('$asin', '$title', $price)";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function fDeleteFromDatabase($asin) {
    $myDB = fConnectToDatabase();
    $sql = "DELETE FROM dvdtitles WHERE asin ='$asin'";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function fListFromDatabase() {
    $myDB = fConnectToDatabase();
    $sql = 'SELECT asin, title, price FROM dvdtitles';
    $bth = $myDB->prepare($sql);
    $bth->execute();
    $result = $bth->fetchAll();
    foreach ($result as $row => $link) {
        echo $link['asin']. ' ' . $link['title'] . ' ' . $link['price'] . "<br>" ."<img src=http://images.amazon.com/images/P/" . $link['asin'] . ".01.MZZZZZZZ.jpg />";
        echo "<br>" . PHP_EOL;
    }
}

function cInsertToDatabase($fname, $lname) {
    $myDB = fConnectToDatabase();
    $sql = "INSERT INTO dvdActors (fname, lname) VALUES ('$fname', '$lname')";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function cDeleteFromDatabase($actorID) {
    $myDB = fConnectToDatabase();
    $sql = "DELETE FROM dvdActors WHERE actorID ='$actorID'";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function cListFromDatabase() {
    $myDB = fConnectToDatabase();
    $sql = 'SELECT actorID, fname, lname FROM dvdActors';
    $bth = $myDB->prepare($sql);
    $bth->execute();
    $result = $bth->fetchAll();
    foreach ($result as $row => $link) {
        echo $link['actorID']. ' ' . $link['fname'] . ' ' . $link['lname'];
        echo "<br>" . PHP_EOL;
    }
}

function getMovie($asin){
    echo "<br>" . PHP_EOL;
    $myDB = fConnectToDatabase();
    $sql = 'SELECT asin, title, price FROM dvdtitles WHERE asin = ' . "'" . $asin . "'";
    //echo $sql . PHP_EOL;
    $bth = $myDB->prepare($sql);
    $bth->execute();
    $link = $bth->fetch();
    echo $link['asin']. "<br>" . $link['title'] . ' ' . "$" . $link['price'] . "<br>" ."<img src=http://images.amazon.com/images/P/" . $link['asin'] . ".01.MZZZZZZZ.jpg />";
    echo "<br>" . PHP_EOL;
}


function getActors($actorID) {
    echo "<br>" . PHP_EOL;
    $myDB = fConnectToDatabase();
    $sql = 'SELECT actorID, fname, lname FROM dvdActors WHERE actorID = ' . "'" . $actorID . "'";
    $bth = $myDB->prepare($sql);
    $bth->execute();
    $link = $bth->fetch();
    echo $link['actorID']. ' ' . $link['fname'] . ' ' . $link['lname'];
}

function deleteTitleActor($asin, $actorID) {
    $myDB = fConnectToDatabase();
    $sql = "DELETE FROM ActorTitles WHERE actorID ='$actorID' AND asin = '$asin'";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function insertTitleActor($asin, $actorID) {
    $myDB = fConnectToDatabase();
    $sql = "INSERT INTO ActorTitles (asin, actorID) VALUES ('$asin', '$actorID')";
    $sth = $myDB->prepare($sql);
    $sth->execute();
}

function joinTitleActor($asin) {
    $myDB = fConnectToDatabase();
    $sql = 'SELECT actorID FROM ActorTitles WHERE asin = ' . "'" . $asin . "'";
    $bth = $myDB->prepare($sql);
    $bth->execute();
    $result = $bth->fetchAll();
    getMovie($asin);
    echo 'Actors in the Movie: ';
    foreach ($result as $row => $link) {
        getActors($link['actorID']);
    }

}

?>
