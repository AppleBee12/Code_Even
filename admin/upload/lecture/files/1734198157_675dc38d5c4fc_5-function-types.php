<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Types</title>
</head>
<body>
    <h1>JavaScript Function Types</h1>
    <script>
        // Regular Function
        function regularFunction() {
            console.log("This is a regular function.");
        }
        regularFunction();

        // Anonymous Function
        let anonymousFunction = function() {
            console.log("This is an anonymous function.");
        };
        anonymousFunction();

        // Immediately Invoked Function Expression (IIFE)
        (function() {
            console.log("This is an immediately invoked function.");
        })();

        // Arrow Function
        const arrowFunction = () => {
            console.log("This is an arrow function.");
        };
        arrowFunction();
    </script>
</body>
</html>
