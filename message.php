<?php
include './admin/connection/config.php';
$getMesg = mysqli_real_escape_string($con, $_POST['text']);

// First, query the chatbot table for a matching question
$query = "SELECT replies FROM chatbot WHERE question = '$getMesg'";
$result = mysqli_query($con, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // If a matching question is found in chatbot, retrieve and display the reply
        $row = mysqli_fetch_assoc($result);
        $reply = $row['replies'];
        echo $reply;
    } else {
        // If no match in chatbot, check if the user input is numeric
        if (!is_numeric($getMesg)) {
            echo "This is for confirmation of identity only. Please enter an ID number only.";
        } else {
            // Query the agri_farmers table for a matching ID
            $check_data = "SELECT firstname, middlename, surname FROM agri_farmers WHERE id = '$getMesg'";
            $run_query = mysqli_query($con, $check_data);

            if (mysqli_num_rows($run_query) > 0) {
                $fetch_data = mysqli_fetch_assoc($run_query);
                $fullname = $fetch_data['firstname'] . ' ' . $fetch_data['middlename'] . ' ' . $fetch_data['surname'];
                echo "Confirmed Identity the full name of this person is: " . $fullname;
            } else {
                $pageConfirmationMessages = array(
                    "I couldn't find a matching question or ID. Please try again.",
                    "Sorry, I couldn't locate any information for the provided input.",
                    "It seems there's no matching ID or question in our records.",
                    "Hmm, I couldn't find any information for that input.",
                    "Please Enter a valid Registration ID or question."
                );
                $randomPageConfirmation = $pageConfirmationMessages[array_rand($pageConfirmationMessages)];
                echo $randomPageConfirmation;
                echo " Please make sure you've entered a valid Registration ID or question.";
            }
        }
    }
} else {
    echo "Error querying the database.";
}
?>
