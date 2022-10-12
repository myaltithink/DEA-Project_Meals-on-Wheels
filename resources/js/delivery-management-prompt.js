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
            fetch('http://localhost:8000/get-available-users/'+ e.target.getAttribute('data-select-order'))
                .then(response => {
                    response.json()
                        .then(data => {

                            const cards = document.getElementById("personnel-display");
                            if (cards.children.length != 0){
                                while (cards.firstChild) {
                                    cards.removeChild(cards.firstChild);
                                }
                            }

                            data.forEach( p => {

                                const card = document.createElement('div');
                                card.classList.add('card');

                                const cardBody = document.createElement('div');
                                cardBody.classList.add('card-body');
                                card.append(cardBody);

                                const header = document.createElement('h1');
                                header.classList.add('fw-bold');
                                header.innerHTML = p.role == "ROLE_VOLUNTEER" ? p.volunteer_details.volunteer_name : p.partner_details.partner_name;
                                cardBody.append(header);

                                //distance
                                const mainbody1 = document.createElement('div');
                                mainbody1.classList.add('d-flex');
                                cardBody.append(mainbody1);

                                const strong1 = document.createElement('span');
                                strong1.classList.add('fw-bold');
                                strong1.innerHTML = 'Distance: ';
                                mainbody1.append(strong1);

                                const span1 = document.createElement('span');
                                span1.classList.add('ms-2');
                                span1.innerHTML = p.distance + "km";
                                mainbody1.append(span1);

                                //volunteer name thingy if applicable
                                if (p.role == "ROLE_VOLUNTEER"){
                                    const mainbody2 = document.createElement('div');
                                    mainbody2.classList.add('d-flex');
                                    cardBody.append(mainbody2);

                                    const strong2 = document.createElement('span');
                                    strong2.classList.add('fw-bold');
                                    strong2.innerHTML = 'Volunteer Organization: ';
                                    mainbody2.append(strong2);

                                    const span2 = document.createElement('span');
                                    span2.classList.add('ms-2');
                                    span2.innerHTML = p.volunteer_details.organization_name;
                                    mainbody2.append(span2);
                                }

                                const cardFooter = document.createElement('div');
                                cardFooter.classList.add('card-footer');
                                cardFooter.classList.add('bg-transparent');
                                cardFooter.classList.add('border-0');
                                card.append(cardFooter);

                                const button = document.createElement('button');
                                button.classList.add('categ-link');
                                button.classList.add('border');
                                button.classList.add('border-0');
                                button.classList.add('bg-transparent');
                                button.style.height = 0;
                                button.style.width = 0;
                                button.setAttribute('data-select-personel', p.user_id);
                                cardFooter.append(button);

                                cards.append(card);
                            });


                            //for selecting a partner/volunteer for preparing order(admin)
                            document.querySelectorAll('[data-select-personel]').forEach(element => {
                                element.addEventListener('click', e => {
                                    document.querySelector('#selected-person').value = e.target.getAttribute('data-select-personel');
                                    document.querySelector("#assign-order").submit();
                                });
                            });

                        });
                });
        });
    });

    //dismiss modal for selecting partner/volunteer for order (admin)
    document.querySelectorAll('[data-select-remove]').forEach(element => {
        element.addEventListener('click', () => {
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
