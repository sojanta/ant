<?php
$jsonData = file_get_contents('employees.json');
$employees = json_decode($jsonData, true);

$totalSalary = 0;
$employeeCount = count($employees);

foreach ($employees as $employee) {
    $totalSalary += $employee['salary'];
}

$averageSalary = $totalSalary / $employeeCount;

$aboveAverageEmployees = array_filter($employees, function($employee) use ($averageSalary) {
    return $employee['salary'] > $averageSalary;
});

echo "<h1>Сотрудники с зарплатой выше средней (Средняя зарплата: " . number_format($averageSalary, 2) . ")</h1>";
if (empty($aboveAverageEmployees)) {
    echo "<p>Нет сотрудников с зарплатой выше средней.</p>";
} else {
    echo "<ul>";
    foreach ($aboveAverageEmployees as $employee) {
        echo "<li>" . htmlspecialchars($employee['name']) . " - " . htmlspecialchars($employee['position']) . " - " . htmlspecialchars($employee['salary']) . " руб.</li>";
    }
    echo "</ul>";
}
?>