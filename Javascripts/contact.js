const $ = jQuery;
const FORM_SELECTOR = '.form-inline';
const BUTTON_SELECTOR = '.btn.btn-default';
const NAME = '.form-control.name';
const EMAIL = '.form-control.email';
const MESSAGE = '.message_input';
const URL = 'index.php';

$(document).ready(function()
{
    $submit_button = $(BUTTON_SELECTOR);
    $name = $(NAME);
    $email = $(EMAIL);
    $message = $(MESSAGE);
    $div = $('<div>', {class: 'contactMessage'});
    $form = $(FORM_SELECTOR);

    $form.on('submit', function(event)
    {
        event.preventDefault();

        let name = $name.val();
        let email = $email.val();
        let message = $message.val();

        $.ajax(
        {
            url:URL,
            type: 'POST',
            data: 
            {
                page: 'ajax_contact',
                name,
                email,
                message
            },

            success: (data) =>
            {
                console.log(data);
                $div.empty();
                $div.append(data);
                $('footer').before($div);
            }
        })
    })
})