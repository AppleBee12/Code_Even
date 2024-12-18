<!-- File: 3-jquery-gustation.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Gustation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>jQuery Gustation</h1>
    <p id="hover-text">Hover over me to change the text!</p>

    <script>
        $(document).ready(function() {
            $('#hover-text').hover(
                function() {
                    $(this).text('You hovered over me!');
                },
                function() {
                    $(this).text('Hover over me to change the text!');
                }
            );
        });
    </script>
</body>
</html>