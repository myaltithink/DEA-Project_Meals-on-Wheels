import  generateElement  from './element-factory';

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
                                const card = generateElement('div', ['card']);

                                const cardBody = generateElement('div', ['card-body']);
                                card.append(cardBody);

                                const header = generateElement('h1', ['fw-bold'], p.role == "ROLE_VOLUNTEER" ? p.volunteer_details.volunteer_name : p.partner_details.partner_name);
                                cardBody.append(header);

                                //distance
                                const distanceContainer = generateElement('div', ['div-flex']);
                                cardBody.append(distanceContainer);

                                const distanceText = generateElement('span', ['fw-bold'], 'Distance: ');
                                distanceContainer.append(distanceText);

                                const distanceValue = generateElement('span', ['ms-2', 'text-muted'], p.distance + "km");
                                distanceContainer.append(distanceValue);

                                //volunteer name if applicable
                                if (p.role == "ROLE_VOLUNTEER"){
                                    const volunteerContainer = generateElement('div', ['d-flex']);
                                    cardBody.append(volunteerContainer);

                                    const volunteerText = generateElement('span', ['fw-bold'], 'Volunteer Organization: ');
                                    volunteerContainer.append(volunteerText);

                                    const volunteerValue = generateElement('span', ['ms-2'], p.volunteer_details.organization_name);
                                    volunteerContainer.append(volunteerValue);
                                }

                                const cardFooter = generateElement('div', ['card-footer', 'bg-transparent', 'border-0']);
                                card.append(cardFooter);

                                const button = generateElement('button', ['categ-link', 'border', 'border-0', 'bg-transparent'], null, {'data-select-personel': p.user_id});
                                button.style.height = 0;
                                button.style.width = 0;
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
