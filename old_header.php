<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        $domain = $_SERVER['HTTP_HOST'];
        $pageTitle = isset($title) ? "$title | $domain" : $domain;
        echo $pageTitle;
        ?>
    </title>
    <!-- Font Awesome einbinden -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Standard-Styling -->
    <link rel="stylesheet" href="/essensplan/assets/style.css"> 

</head>
<body>
<header>
    <div class="header-container">
        <h1><?php echo $title; ?></h1>
        <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
    </div>
    <nav id="menu" class="hidden"> <!-- Versteckt das Menü initial -->
        <ul>
            <li><a href="/essensplan/index.php">Home</a></li>
            <li><a href="/essensplan/src/view_recipes.php">Rezepte verwalten</a></li>
            <li><a href="/essensplan/src/view_categories.php">Mahlzeitenkategorien verwalten</a></li>
            <li><a href="/essensplan/src/view_weeks.php">Wochenpläne verwalten</a></li> <!-- Wochenpläne verwalten -->
            <li><a href="/essensplan/src/archived_weeks.php">Archivierte Essenspläne</a></li> <!-- Archivierte Essenspläne -->
        </ul>
    </nav>
</header>

<script>
    // Funktion zum Umschalten des Burger-Menüs
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("active"); // Menü bei Klick anzeigen/verstecken
    }
</script>
