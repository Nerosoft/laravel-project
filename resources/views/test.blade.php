<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Date Picker</title>
  <style>
    /* Style to hide the default calendar icon */
    input[type="date"]::-webkit-calendar-picker-indicator {
      display: none;
    }

    /* Custom date icon style */
    .date-picker-wrapper {
      position: relative;
    }

    .custom-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    input[type="date"] {
      padding-right: 30px; /* Adjust padding to fit the icon */
    }
  </style>
</head>
<body>
  <div class="date-picker-wrapper">
    <input type="date" id="date" name="date">
    <span class="custom-icon" onclick="openDatePicker()">📅</span> <!-- Your custom icon -->
  </div>

  <script>
    function openDatePicker() {
      const dateInput = document.getElementById('date');
      dateInput.showPicker(); // Opens the date picker on click
    }
  </script>
</body>
</html>
