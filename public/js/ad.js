
$('#add-image').click(function(){

    // First step: I pick up the fields' number I am about to create
    const index = +$('#widgets-counter').val();
    console.log(index);
    

    // Now I want the entries' prototype

    const tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);

    // console.log(tmpl);
    $('#ad_images').append(tmpl);

    $('#widgets-counter').val(index + 1);

    // here we handle the delete button
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        // console.log(target);
        $(target).remove();
    })
}

function updateCounter() {
    const count = $('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
// everytime the page loads we call the function
handleDeleteButtons();
