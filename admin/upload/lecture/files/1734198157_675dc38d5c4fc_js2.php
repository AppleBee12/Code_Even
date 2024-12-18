<!-- File: 2-default-selector.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Default Selector</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>jQuery Default Selector</h1>
    <ul>
        <li class="item">Item 1</li>
        <li class="item">Item 2</li>
        <li>Item 3</li>
    </ul>
    <button id="btn-highlight">Highlight Items</button>

    <script>
        $(document).ready(function() {
            $('#btn-highlight').click(function() {
                $('.item').css('color', 'red');
            });
        });
    </script>
</body>
</html>