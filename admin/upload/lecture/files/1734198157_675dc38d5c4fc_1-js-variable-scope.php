<!-- File: 1-js-variable-scope.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Variable Scope</title>
</head>
<body>
    <h1>JavaScript Variable Scope</h1>
    <p>Check the console for variable scope examples.</p>
    <script>
        function variableScope() {
            var x = 'function scope';
            if (true) {
                let y = 'block scope';
                const z = 'constant block scope';
                console.log(y);
                console.log(z);
            }
            console.log(x);
        }
        variableScope();
    </script>
</body>
</html>