document.addEventListener('DOMContentLoaded', ()=>{

    //for popping up modal and selecting meal order
    document.querySelectorAll('.meal-select-prompt').forEach(element => {
        element.addEventListener('click', (e)=>{
              e.preventDefault();
              document.getElementById('select-meal').value = e.target.getAttribute('data-meal-value');
        })
    });

    //for removing the modal
    document.querySelectorAll('[data-meal-remove]').forEach(element => {
        element.addEventListener('click', (e) => {
            document.querySelector(e.target.getAttribute('data-meal-remove')).value = "";
        });
    });

    //for popping modal and selecting order (admin)
    document.querySelectorAll('[data-select-order]').forEach(element => {
        element.addEventListener('click', e =>{
            document.querySelector('#selected-order').value = e.target.getAttribute('data-select-order');
        });
    });

    //for selecting a partner/volunteer for preparing order(admin)
    document.querySelectorAll('[data-select-personel]').forEach(element => {
        element.addEventListener('click', e => {
            document.querySelector('#selected-person').value = e.target.getAttribute('data-select-personel');
            document.querySelector("#assign-order").submit();
        });
    });

    //dismiss modal for selecting partner/volunteer for order (admin)
    document.querySelectorAll('[data-select-remove]').forEach(element => {
        element.addEventListener('click', e => {
            document.querySelector('#selected-order').value = "";
            document.querySelector('#selected-person').value = "";
        });
    });

    //for selecting meal for delivering order (admin)
    document.querySelectorAll('[data-select-meal-delivery]').forEach(element =>{
        element.addEventListener('click', e => {
            document.querySelector('#selected-order').value = e.target.getAttribute('data-select-meal-delivery');
        });
    });

    //for selecting a volunteer for delivering order (admin)
    document.querySelectorAll('[data-select-rider]').forEach(element => {
        element.addEventListener('click', e => {
            document.querySelector('#selected-person').value = e.target.getAttribute('data-select-rider');
            document.querySelector("#assign-order-deliver").submit();
        })
    });

    //for opening modal for partner to assign employee to deliver.
    document.querySelectorAll('[data-assign-delivery]').forEach(element => {
        element.addEventListener('click', e => {
            document.querySelector('#selected-order').value = e.target.getAttribute('data-assign-delivery');
        });
    });
});
