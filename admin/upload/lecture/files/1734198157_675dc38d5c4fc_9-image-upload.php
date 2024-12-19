<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <h1>Upload an Image</h1>
    <form action="upload-image.php" method="POST" enctype="multipart/form-data">
        <label for="image">Choose an image:</label>
        <input type="file" id="image" name="image" required>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>