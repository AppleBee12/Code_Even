<!-- File: 2-js-execution-context.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Execution Context</title>
</head>
<body>
    <h1>JavaScript Execution Context</h1>
    <p>Open the console to see the execution context behavior.</p>
    <script>
        function firstFunction() {
            console.log('Inside firstFunction');
            secondFunction();
        }

        function secondFunction() {
            console.log('Inside secondFunction');
        }

        console.log('Global Execution Context');
        firstFunction();
    </script>
</body>
</html>