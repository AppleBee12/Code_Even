<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Scope and Variables</title>
</head>
<body>
    <h1>JavaScript Functions and Scope</h1>
    <script>
        // Function Declaration
        function greet() {
            let localVariable = "I'm local";
            console.log("Hello, this is a function!");
            console.log(localVariable);
        }
        greet();

        // Global Variable
        let globalVariable = "I'm global";
        console.log(globalVariable);

        // Function with Parameters and Return
        function add(a, b) {
            return a + b;
        }
        console.log("Sum of 5 and 10:", add(5, 10));
    </script>
</body>
</html>