<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Language</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .language-dropdown {
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            padding: 10px;
        }
        .language-dropdown:hover {
            background-color: #0056b3;
            cursor: pointer;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h4>Select Language</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="languageSelect">Choose a Language:</label>
                <select class="form-select" id="languageSelect">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                </select>
            </div>
            <div class="text-center">
                <button class="btn language-dropdown" id="changeLanguageBtn">Change Language</button>
            </div>
            <div class="mt-3" id="output">
                <p>Current language: <span id="selectedLanguage">English</span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // When the "Change Language" button is clicked
        $('#changeLanguageBtn').click(function() {
            var selectedLang = $('#languageSelect').val();
            var languageName = $('#languageSelect option:selected').text();

            // Update the displayed language
            $('#selectedLanguage').text(languageName);

            // You can perform actions like switching the website content based on selected language here
            alert("Language changed to: " + languageName);
        });
    });
</script>

</body>
</html>
