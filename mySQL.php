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

?>
