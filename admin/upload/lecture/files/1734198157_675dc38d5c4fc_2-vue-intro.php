<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue.js Introduction</title>
</head>
<body>
    <h1>Vue.js Introduction</h1>
    <p>Below is a simple Vue.js instance example:</p>
    <div id="app">
        <p>{{ message }}</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                message: 'Hello, Vue.js!'
            }
        });
    </script>
</body>
</html>