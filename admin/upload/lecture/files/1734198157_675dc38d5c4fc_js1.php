<!-- File: 1-jquery-summary.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Summary</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>jQuery Summary</h1>
    <p>This file introduces basic jQuery concepts.</p>
    <button id="btn-summary">Click Me</button>
    <p id="summary-text"></p>

    <script>
        $(document).ready(function() {
            $('#btn-summary').click(function() {
                $('#summary-text').text('jQuery is a fast, small, and feature-rich JavaScript library.');
            });
        });
    </script>
</body>
</html>