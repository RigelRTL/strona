<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $target_dir = "uploads/"; // Twój folder docelowy na serwerze
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Sprawdzamy, czy plik już istnieje
    if (file_exists($target_file)) {
        echo "Plik już istnieje.";
        $uploadOk = 0;
    }
    
    // Sprawdzamy rozmiar pliku
    if ($_FILES["file"]["size"] > 500000) {
        echo "Twój plik jest zbyt duży.";
        $uploadOk = 0;
    }
    
    // Dozwolone formaty plików
    $allowed_formats = array("jpg", "png", "jpeg", "gif", "pdf"); // Dodaj więcej formatów, jeśli potrzebujesz
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Dozwolone są tylko pliki JPG, JPEG, PNG, GIF i PDF.";
        $uploadOk = 0;
    }
    
    // Jeśli wszystko jest w porządku, to przenieś plik na serwer
    if ($uploadOk == 0) {
        echo "Twój plik nie został przesłany.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "Plik " . htmlspecialchars(basename($_FILES["file"]["name"])) . " został przesłany.";
        } else {
            echo "Wystąpił błąd podczas przesyłania pliku.";
        }
    }
}
?>
