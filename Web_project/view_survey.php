<?php
    include "db.php";

    class Feedback {
        public $college, $year, $freq, $quality, $taste, $food, $drinks, $suggestions;

        function __construct($c,$y,$f,$q,$t,$fo,$d,$s) {
            $this->college=$c;
            $this->year=$y;
            $this->freq=$f;
            $this->quality=$q;
            $this->taste=$t;
            $this->food=$fo;
            $this->drinks=$d;
            $this->suggestions=$s;
        }
    }


    $list = [];
    $res = $conn->query("SELECT * FROM food_feedback");

    while ($r = $res->fetch_assoc()) {
        $list[] = new Feedback(
            $r['college'], $r['year'], $r['freq'],
            $r['quality'], $r['taste'], $r['food'],
            $r['drinks'], $r['suggestions']
        );
    }



    echo "<table border='1'>";
    echo "<tr>
         <th>College</th><th>Year</th><th>Frequency</th>
         <th>Quality</th><th>Taste</th><th>Food</th>
         <th>Drinks</th><th>Suggestions</th>
         </tr>";

    foreach ($list as $f) {
        echo "<tr>
            <td>$f->college</td>
            <td>$f->year</td>
            <td>$f->freq</td>
            <td>$f->quality</td>
            <td>$f->taste</td>
            <td>$f->food</td>
            <td>$f->drinks</td>
            <td>$f->suggestions</td>
        </tr>";
    }
    echo "</table>";
?>
