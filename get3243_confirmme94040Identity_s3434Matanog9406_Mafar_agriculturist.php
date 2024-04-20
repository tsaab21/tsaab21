<?php 
session_start();
include './admin/connection/config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate page based on user type
    if ($_SESSION['usertype'] == 'admin') {
        header("Location: ./admin/index.php");
        exit;
    } elseif ($_SESSION['usertype'] == 'staff') {
        header("Location: ./staff/index.php"); // You can replace this with the actual path for the user dashboard
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agri-bot</title>
    <link rel="stylesheet" href="css/bot.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Confirmation of Identity</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-person"></i>
                </div>
                <div class="msg-header">
                    <p>Hi! How can I assist you? I was created for the sole purpose of confirming identities.</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
    let inputTimer;

    $("#send-btn").on("click", function () {
        clearTimeout(inputTimer);

        $value = $("#data").val();
        $userMsg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
        $(".form").append($userMsg);
        $("#data").val('');

        // Show "Typing..." message for 7 seconds
        $typingMsg = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>Typing...</p></div></div>';
        $(".form").append($typingMsg);

        setTimeout(function () {
            // Remove "Typing..." message
            $(".bot-inbox:contains('Typing...')").remove();

            // Start ajax code
            $.ajax({
                url: 'message.php',
                type: 'POST',
                data: 'text=' + $value,
                success: function (result) {
                    $reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
                    $(".form").append($reply);
                    // When chat goes down, the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }
            });
        }, 7000); // 7-second typing delay

        // Set a timer to disable the input after 3 minutes (180,000 milliseconds)
        inputTimer = setTimeout(function () {
            $("#data").prop('disabled', true);
        }, 180000); // 3-minute timer
    });
});

</script>





   
    
</body>
</html>