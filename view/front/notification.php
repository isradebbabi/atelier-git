<?php
session_start();

// Set a default value for $notificationMessage
$notificationMessage = "";

if (isset($_SESSION["notification_message"])) {
    $notificationMessage = $_SESSION["notification_message"];

    // Clear the notification message from the session
    unset($_SESSION["notification_message"]);
}

// Check if the hebergement ID is set and not empty
if (isset($_SESSION["id_heb"]) && !empty($_SESSION["id_heb"])) {
    $id_heb = $_SESSION["id_heb"];
    // Append the hebergement ID to the notification message
    $notificationMessage .= " Hebergement ID: $id_heb";
    // Clear the hebergement ID from the session
    unset($_SESSION["id_heb"]);
}

// Return the notification message as JSON
echo json_encode(array("notification_message" => $notificationMessage));
header("location='addhebrgeemtn.php'");
?>


<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .notification {
  width: 360px;
  padding: 15px;
  background-color: white;
  border-radius: 16px;
  position: fixed;
  bottom: 15px;
  left: 15px;
  transform: translateY(200%);
  -webkit-animation: noti 2s infinite forwards alternate ease-in;
          animation: noti 2s infinite forwards alternate ease-in;
}

        .notification-message {
            font-weight: bold;
            display: block;
            margin-bottom: 1000px;
        }

        .notification-text {
  margin-bottom: 5px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  padding-right: 50px;
}

        .notification-reaction {
  width: 300px;
  height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 300px;
  color: white;
  background-image: linear-gradient(45deg, #0070E1, #14ABFE);
  font-size: 140px;
  position: absolute;
  bottom: 0;
  right: 0;
}

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3b5998;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2a4373;
        }


        
    </style>
</head>
<body>
    <div class="container">
        <div class="notification" id="notification">
            <span class="notification-message"><?php echo $notificationMessage; ?></span>
            <span class="notification-text">Welcome to our website! Enjoy your browsing experience.</span>    
    </div>

    <script>
        function showNotification(message) {
            var notification = document.getElementById("notification");
            var notificationMessage = document.querySelector(".notification-message");
            var notificationText = document.querySelector(".notification-text");
            notificationMessage.innerHTML = message;
            notification.style.display = "block";
            setTimeout(function() {
                notification.style.display = "none";
            }, 3000);
        }

        function proceedToNextStep() {
            // Redirect or perform the next step logic here
            alert("Proceeding to the next step of the reservation");
        }

        document.addEventListener("DOMContentLoaded", function() {
            <?php if (!empty($notificationMessage)): ?>
                var notificationMessage = "<?php echo $notificationMessage; ?>";
                showNotification(notificationMessage);
            <?php endif; ?>
        });
    </script>
</body>
</html>