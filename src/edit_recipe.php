<?php
$title = "Rezept bearbeiten";
require '../header.php';
?>
<main>
    <h2><?php echo $title; ?></h2>
    <?php
    if (isset($_GET['id'])) {
        require_once '../config/db.php';
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recipe) {
            ?>
            <form action="edit_recipe.php?id=<?php echo $recipe['id']; ?>" method="post">
                <label for="title">Titel des Rezepts:</label>
                <input type="text" name="title" value="<?php echo $recipe['title']; ?>" required><br>
                <label for="ingredients">Zutaten:</label>
                <textarea name="ingredients" required><?php echo $recipe['ingredients']; ?></textarea><br>
                <label for="instructions">Zubereitung:</label>
                <textarea name="instructions" required><?php echo $recipe['instructions']; ?></textarea><br>
                <label for="category">Kategorie:</label>
                <input type="text" name="category" value="<?php echo $recipe['category']; ?>" required><br>
                <label for="prep_time">Vorbereitungszeit (Minuten):</label>
                <input type="number" name="prep_time" value="<?php echo $recipe['prep_time']; ?>" required><br>
                <label for="cook_time">Kochzeit (Minuten):</label>
                <input type="number" name="cook_time" value="<?php echo $recipe['cook_time']; ?>" required><br>
                <label for="difficulty">Schwierigkeitsgrad:</label>
                <select name="difficulty">
                    <option value="leicht" <?php echo $recipe['difficulty'] === 'leicht' ? 'selected' : ''; ?>>Leicht</option>
                    <option value="mittel" <?php echo $recipe['difficulty'] === 'mittel' ? 'selected' : ''; ?>>Mittel</option>
                    <option value="schwer" <?php echo $recipe['difficulty'] === 'schwer' ? 'selected' : ''; ?>>Schwer</option>
                </select><br>
                <label for="servings">Portionen:</label>
                <input type="number" name="servings" value="<?php echo $recipe['servings']; ?>" required><br>
                <input type="submit" value="Rezept speichern">
            </form>
            <?php
        } else {
            echo "<p>Rezept nicht gefunden.</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $conn->prepare("UPDATE recipes SET title = ?, ingredients = ?, instructions = ?, category = ?, prep_time = ?, cook_time = ?, difficulty = ?, servings = ? WHERE id = ?");
        if ($stmt->execute([$_POST['title'], $_POST['ingredients'], $_POST['instructions'], $_POST['category'], $_POST['prep_time'], $_POST['cook_time'], $_POST['difficulty'], $_POST['servings'], $_GET['id']])) {
            echo "<p>Rezept erfolgreich aktualisiert!</p>";
        } else {
            echo "<p>Fehler beim Aktualisieren des Rezepts.</p>";
        }
    }
    ?>
</main>
<?php
include '../footer.php';
?>
