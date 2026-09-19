<?php
$students = [
    ["name" => "Joan",   "surname" => "Joanson",  "year" => 2005, "marks" => ["PHP" => 4, "JS" => 3, "HTML" => 5]],
    ["name" => "Jack",   "surname" => "Smith",    "year" => 2003, "marks" => ["PHP" => 3, "JS" => 3, "HTML" => 4]],
    ["name" => "Martin", "surname" => "Miller",   "year" => 2004, "marks" => ["PHP" => 4, "JS" => 3, "HTML" => 5]],
    ["name" => "Alice",  "surname" => "Brown",    "year" => 2002, "marks" => ["PHP" => 5, "JS" => 5, "HTML" => 4]],
    ["name" => "Emma",   "surname" => "Davis",    "year" => 2006, "marks" => ["PHP" => 3, "JS" => 4, "HTML" => 3]],
    ["name" => "Oliver", "surname" => "Wilson",   "year" => 2001, "marks" => ["PHP" => 5, "JS" => 4, "HTML" => 5]],
    ["name" => "Sophia", "surname" => "Taylor",   "year" => 2004, "marks" => ["PHP" => 2, "JS" => 3, "HTML" => 3]],
    ["name" => "Liam",   "surname" => "Anderson", "year" => 2003, "marks" => ["PHP" => 4, "JS" => 4, "HTML" => 4]],
];

// Add an "average" field to every student (by reference, so it's saved back)
array_walk($students, function (&$student) {
    $student['average'] = round(array_sum($student['marks']) / count($student['marks']), 2);
});

// Formats and prints one student card.
// Matches array_walk()'s callback signature: ($value[, $key]).
function printStudent($student)
{
    echo "<div class='student-card'>";
    echo "<div class='student-header'>"
       . "<span class='name'>{$student['name']} {$student['surname']}</span>"
       . "<span class='year'>b. {$student['year']}</span>"
       . "</div>";

    echo "<ul class='marks'>";
    foreach ($student['marks'] as $subject => $grade) {
        echo "<li><span class='subject'>{$subject}</span><span class='grade'>{$grade}</span></li>";
    }
    echo "</ul>";

    echo "<div class='average'>Average grade: {$student['average']}</div>";
    echo "</div>";
}

// Prints a titled section containing a list of student cards.
function printSection($title, $studentsList)
{
    echo "<h2>{$title}</h2><div class='student-list'>";
    array_walk($studentsList, 'printStudent');
    echo "</div>";
}

echo "<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; padding: 20px; }
    h2 { color: #0f172a; border-bottom: 2px solid #8b5cf6; padding-bottom: 4px; margin-top: 34px; }
    .student-list { display: flex; flex-wrap: wrap; gap: 14px; }
    .student-card {
        background: #ffffff; border-radius: 8px; padding: 14px 16px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1); width: 220px; border-top: 4px solid #8b5cf6;
    }
    .student-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px; }
    .student-header .name { font-weight: bold; }
    .student-header .year { font-size: 12px; color: #64748b; }
    ul.marks { list-style: none; padding: 0; margin: 0 0 8px 0; }
    ul.marks li { display: flex; justify-content: space-between; font-size: 13px; padding: 2px 0; color: #475569; }
    ul.marks .grade { font-weight: bold; color: #7c3aed; }
    .average {
        margin-top: 6px; font-size: 13px; font-weight: bold; color: #ffffff;
        background: #8b5cf6; padding: 3px 8px; border-radius: 10px; display: inline-block;
    }
</style>";

// 1) Original order, with grades and averages
printSection("All students", $students);

// 2) Sorted by first name
$byName = $students;
usort($byName, function ($a, $b) {
    return $a['name'] <=> $b['name'];
});
printSection("Sorted by first name", $byName);

// 3) Sorted by last name
$bySurname = $students;
usort($bySurname, function ($a, $b) {
    return $a['surname'] <=> $b['surname'];
});
printSection("Sorted by last name", $bySurname);

// 4) Sorted by year of birth
$byYear = $students;
usort($byYear, function ($a, $b) {
    return $a['year'] <=> $b['year'];
});
printSection("Sorted by year of birth", $byYear);

// 5) Sorted by average grade
$byAverage = $students;
usort($byAverage, function ($a, $b) {
    return $a['average'] <=> $b['average'];
});
printSection("Sorted by average grade", $byAverage);

// 6) Split the group into 4 subgroups
$subgroupSize = (int) ceil(count($students) / 4);
$subgroups = array_chunk($students, $subgroupSize);
foreach ($subgroups as $index => $subgroup) {
    $groupNumber = $index + 1;
    printSection("Subgroup {$groupNumber}", $subgroup);
}