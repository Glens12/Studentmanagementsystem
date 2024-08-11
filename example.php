<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <button id="showPopup">Show Popup</button>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" id="closePopup">&times;</span>
            <h2>Popup Title</h2>
            <p>This is the content of the popup.</p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
    const showPopupButton = document.getElementById('showPopup');
    const closePopupButton = document.getElementById('closePopup');
    const popup = document.getElementById('popup');

    showPopupButton.addEventListener('click', () => {
        popup.style.display = 'flex';
    });

    closePopupButton.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    // Optional: Close the popup when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});

</script>

<style type="text/css">
    body {
    font-family: Arial, sans-serif;
}

#popup {
    display: none; /* Hidden by default */
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 300px;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

button {
    padding: 10px 20px;
    font-size: 16px;
}

</style>