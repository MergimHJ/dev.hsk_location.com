<?php


function contact()
{
    render('contact/contact.php', []);
}


function send()
{
    // ici on traite le form (db ou sendmail)

    $sendingWentFine = true;

    if($sendingWentFine){
        render('contact/success.php');
    }
    else{
        $data['message'] = 'Oops';
        $data['post_data'] = $_POST;
        $data['head_title'] = 'erreur de contact';
        render('contact/contact.php', $data);
    }
}