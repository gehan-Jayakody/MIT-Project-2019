<?php
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<th>" . parent::current(). "</th>";
    }

    function beginChildren() { 
        echo "<tr class='text-center'>"; 
    } 

    function endChildren() { 
        echo "</tr>";
    } 
}
?>