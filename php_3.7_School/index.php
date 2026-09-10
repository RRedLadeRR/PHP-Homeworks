<?php

$n = rand(1, 13);

echo "Number: " . $n . "<br>";

switch ($n) {
    case 1:
        echo "Learning letters";
        break;
    case 2:
        echo "Let's learn the multiplication table";
        break;
    case 3:
        echo "Getting familiar with grammar rules";
        break;
    case 4:
        echo "Basics of geometry";
        break;
    case 5:
        echo "Introduction to natural sciences";
        break;
    case 6:
        echo "Exploring world history";
        break;
    case 7:
        echo "Algebra fundamentals";
        break;
    case 8:
        echo "Physics and chemistry basics";
        break;
    case 9:
        echo "Preparing for advanced studies";
        break;
    case 10:
        echo "Deepening subject knowledge";
        break;
    case 11:
        echo "Getting ready for final exams";
        break;
    case 12:
        echo "We've learned almost everything!";
        break;
    default:
        echo "We don't have such a class!";
        break;
}
