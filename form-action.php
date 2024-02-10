<?php
// Function to sanitize form input
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = sanitizeInput($_POST["name"]);
    $arrival_date = sanitizeInput($_POST["arrival_date"]);
    $departure_date = sanitizeInput($_POST["departure_date"]);
    $arrival_time_flight = sanitizeInput($_POST["arrival_time_fligt"]);
    $departure_time_flight = sanitizeInput($_POST["departure_time_fligt"]);

    // CSV file path
    $csvFile = 'form_data.csv';

    // Check if the file exists, if not, create it and add header
    if (!file_exists($csvFile)) {
        $header = array("Name", "Arrival Date", "Departure Date", "Arrival Time & Flight No", "Departure Time & Flight No");
        $fp = fopen($csvFile, 'w');
        fputcsv($fp, $header);
        fclose($fp);
    }

    // Append form data to CSV file
    $fp = fopen($csvFile, 'a');
    $formData = array($name, $arrival_date, $departure_date, $arrival_time_flight, $departure_time_flight);
    fputcsv($fp, $formData);
    fclose($fp);

    // Redirect to a thank you page or display a success message
    header("Location: airport.html");
    exit();
}
