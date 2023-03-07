
<?php
    $gotResponse = isset($mailchimpResponse) && !empty($mailchimpResponse);
    
?>

<div class="notifier-container">
    <span class="notifier-text<?php if($gotResponse){ if($mailchimpResponse=='400') echo ' red'; else echo ' green'; }?>">
        <?php 
            if($gotResponse){            
                if($mailchimpResponse === "400"){
                    echo "The e-mail address you have given is already registered as a contact.";
                }
                if($mailchimpResponse === "subscribed"){
                    echo "You have been successfully registered as a contact.";
                }
            } 
        ?>
    </span>
</div>