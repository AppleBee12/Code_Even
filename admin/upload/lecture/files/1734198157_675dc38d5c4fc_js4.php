<!-- File: 1-js-basic-syntax.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Basic Syntax</title>
</head>
<body>
    <h1>JavaScript Basic Syntax</h1>
    <p>Check the console for output.</p>
    <script>
        console.log('Hello, World!');
    </script>
</body>
</html>

<!-- File: 2-js-built-in-functions.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Built-in Functions</title>
</head>
<body>
    <h1>JavaScript Built-in Functions</h1>
    <p>Click the button to see the current date.</p>
    <button onclick="showDate()">Show Date</button>
    <p id="date-output"></p>

    <script>
        function showDate() {
            document.getElementById('date-output').textContent = new Date().toString();
        }
    </script>
</body>
</html>