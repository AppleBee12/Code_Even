<!-- File: 3-js-context-components.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Execution Context Components</title>
</head>
<body>
    <h1>JavaScript Execution Context Components</h1>
    <p>Open the console for a breakdown of execution context components.</p>
    <script>
        function showContextComponents() {
            const variableEnvironment = 'Variable Environment Example';
            const lexicalEnvironment = 'Lexical Environment Example';
            const thisBinding = this;

            console.log('Variable Environment:', variableEnvironment);
            console.log('Lexical Environment:', lexicalEnvironment);
            console.log('this Binding:', thisBinding);
        }

        showContextComponents();
    </script>
</body>
</html>
