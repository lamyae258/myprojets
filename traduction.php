<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsoft Translator Example</title>
</head>
<body>
    <p id="text-to-translate">Hello, how are you?</p>

    <select id="language-select">
        <option value="fr">French</option>
        <option value="es">Spanish</option>
        <option value="de">German</option>
    </select>
    <button id="translate-btn">Translate</button>

    <div id="translated-text"></div>

    <script>
        document.getElementById('translate-btn').addEventListener('click', function() {
            var textToTranslate = document.getElementById('text-to-translate').innerText;
            var targetLanguage = document.getElementById('language-select').value;
            var endpoint = 'https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=' + targetLanguage;

            fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Ocp-Apim-Subscription-Key': 'YOUR_API_KEY', 
                    'Ocp-Apim-Subscription-Region': 'YOUR_REGION' 
                },
                body: JSON.stringify([{ 'Text': textToTranslate }])
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('translated-text').innerText = data[0].translations[0].text;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
