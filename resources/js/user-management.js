import generateElement from './element-factory';

/**
 * On load initializes the table
 */
window.addEventListener('DOMContentLoaded', async () => {

    const url = window.location
    if (url.search.includes('view')){
        const selectedUser = url.search.split('=')
        localStorage.setItem('view', selectedUser[1]);
        return window.location.href = '/user-management';
    }

    const view = localStorage.getItem('view');
    const entity = document.querySelector("#select-entity");
    console.log(view)
    if (view != null || view != undefined) {
        entity.value = view
        setTable(view, await selectEntity(view))
        localStorage.removeItem('view');
    }else {
        setTable(entity.value, await selectEntity(entity.value));
    }

    entity.addEventListener('change', async () => {
        setTable(entity.value, await selectEntity(entity.value));
    })
});

/**
 * Function for retrieving collection of user information
 *
 * @param entity this is the chosen entity from the dropdown
 * @returns collection of entities from the database thru fetch
 */
async function selectEntity(entity){
    const attempt = await fetch('http://localhost:8000/users?selected=' + entity);
    return await attempt.json();
}

/**
 * Function for setting the table
 *
 * @param  entity this is the chosen entity from the dropdown
 * @param data this is an array which is a collection of retrieved users
 * @returns
 */
function setTable(entity, data){

    const table = document.getElementById("entity-table");
    if (table.children.length != 0){
        while (table.firstChild) {
            table.removeChild(table.firstChild);
        }
    }
    const tablehead = generateElement('thead');
    const tablebody = generateElement('tbody');
    const tableheadrow = generateElement('tr');
    tablehead.append(tableheadrow);
    table.append(tablehead);
    table.append(tablebody);
    switch(entity){
        case "Partner":
            /*generate partner table*/
            const partnerheaders = ['Partner Id', 'Partner Name', 'Registered By', 'Partner Address','Functions'];

            for (const head of partnerheaders){
                const tableheaders =generateElement('th', null, head);
                tableheadrow.append(tableheaders);
            }

            for (let e of data){
                const tablerow = generateElement('tr');
                tablebody.append(tablerow);

                //partner_id
                const partnerId = generateElement('td', null, e.user_id);
                tablerow.append(partnerId);

                //partner name
                const partnerName = generateElement('td', null, e.partner_details.partner_name);
                tablerow.append(partnerName);

                //registered by
                const registeredBy = generateElement('td', null, e.partner_details.partner_registered_by);
                tablerow.append(registeredBy);

                //partner address
                const partnerAddress = generateElement('td', null, e.partner_details.partner_address);
                tablerow.append(partnerAddress);

                //function
                const actions = generateElement('td', null);
                const updateButton = generateElement('a', ['btn','btn-primary' ,'border','rounded-pill','px-4', 'mx-1'], 'Update', {
                    'href' : '/update_user_profile/' + e.user_id,
                });
                const deleteButton = generateElement('a', ['btn','btn-secondary' ,'border','rounded-pill','px-4', 'mx-1'], 'Delete',
                    {
                        'data-user-delete' : e.user_id,
                        'href' : '/delete-user/' + e.user_id,
                    }
                );
                actions.append(updateButton);
                actions.append(deleteButton);
                tablerow.append(actions);
            }

            break;
        default:
            //generate headers
            const headers = ['User Id', 'Full Name', 'Email', 'Gender', 'Birthday', 'Contact', 'Address', 'Functions'];
            for (const head of headers){
                const tableheaders = generateElement('th', null, head);
                tableheadrow.append(tableheaders);
            }

            switch (entity){
                case "Members":
                    for (let e of data){
                        const tablerow = generateElement('tr');
                        tablebody.append(tablerow);

                        //user id record
                        const userId = generateElement('td', null, e.user_id);
                        tablerow.append(userId);

                        //fullname record
                        const fullName = generateElement('td', null, (e.member_details.profile.first_name + " " + e.member_details.profile.last_name ));
                        tablerow.append(fullName);

                        //email record
                        const email = generateElement('td', null, e.email);
                        tablerow.append(email);

                        //gender
                        const gender = generateElement('td', null, e.member_details.profile.gender);
                        tablerow.append(gender);

                        //birthday
                        const birthday = generateElement('td', null, e.member_details.profile.birthday);
                        tablerow.append(birthday);

                        //contact
                        const contact = generateElement('td', null, e.member_details.profile.contact_number);
                        tablerow.append(contact);

                        //address
                        const address = generateElement('td', null, e.member_details.profile.address);
                        tablerow.append(address);

                        //functions
                        const actions = generateElement('td', null);
                        const updateButton = generateElement('a', ['btn','btn-primary' ,'border','rounded-pill','px-4', 'mx-1'], 'Update', {
                            'href' : '/update_user_profile/' + e.user_id,
                        });
                        const deleteButton = generateElement('a', ['btn','btn-secondary' ,'border','rounded-pill','px-4', 'mx-1'], 'Delete',
                            {
                                'data-user-delete' : e.user_id,
                                'href' : '/delete-user/' + e.user_id,
                            }
                        );
                        actions.append(updateButton);
                        actions.append(deleteButton);
                        tablerow.append(actions);
                    }
                    break;
                case "Caregivers":
                    for (let e of data){
                        const tablerow = generateElement('tr');
                        tablebody.append(tablerow);

                        //user id record
                        const userId = generateElement('td', null, e.user_id);
                        tablerow.append(userId);

                        //fullname record
                        const fullName = generateElement('td', null, (e.caregiver_details.profile.first_name + " " + e.caregiver_details.profile.last_name ));
                        tablerow.append(fullName);

                        //email record
                        const email = generateElement('td', null, e.email);
                        tablerow.append(email);

                        //gender
                        const gender = generateElement('td', null, e.caregiver_details.profile.gender);
                        tablerow.append(gender);

                        //birthday
                        const birthday = generateElement('td', null, e.caregiver_details.profile.birthday);
                        tablerow.append(birthday);

                        //contact
                        const contact = generateElement('td', null, e.caregiver_details.profile.contact_number);
                        tablerow.append(contact);

                        //address
                        const address = generateElement('td', null, e.caregiver_details.profile.address);
                        tablerow.append(address);

                        //functions
                        const actions = generateElement('td', null);
                        const updateButton = generateElement('a', ['btn','btn-primary' ,'border','rounded-pill','px-4', 'mx-1'], 'Update', {
                            'href' : '/update_user_profile/' + e.user_id,
                        });
                        const deleteButton = generateElement('a', ['btn','btn-secondary' ,'border','rounded-pill','px-4', 'mx-1'], 'Delete',
                            {
                                'data-user-delete' : e.user_id,
                                'href' : '/delete-user/' + e.user_id,
                            }
                        );
                        actions.append(updateButton);
                        actions.append(deleteButton);
                        tablerow.append(actions);
                    }
                    break;
                case "Volunteers":
                    for (let e of data){
                        const tablerow = generateElement('tr');
                        tablebody.append(tablerow);

                        //user id record
                        const userId = generateElement('td', null, e.user_id);
                        tablerow.append(userId);

                        //fullname record
                        const fullName = generateElement('td', null, (e.volunteer_details.profile.first_name + " " + e.volunteer_details.profile.last_name ));
                        tablerow.append(fullName);

                        //email record
                        const email = generateElement('td', null, e.email);
                        tablerow.append(email);

                        //gender
                        const gender = generateElement('td', null, e.volunteer_details.profile.gender);
                        tablerow.append(gender);

                        //birthday
                        const birthday = generateElement('td', null, e.volunteer_details.profile.birthday);
                        tablerow.append(birthday);

                        //contact
                        const contact = generateElement('td', null, e.volunteer_details.profile.contact_number);
                        tablerow.append(contact);

                        //address
                        const address = generateElement('td', null, e.volunteer_details.profile.address);
                        tablerow.append(address);

                        //functions
                        const actions = generateElement('td', null);
                        const updateButton = generateElement('a', ['btn','btn-primary' ,'border','rounded-pill','px-4', 'mx-1'], 'Update', {
                            'href' : '/update_user_profile/' + e.user_id,
                        });
                        const deleteButton = generateElement('a', ['btn','btn-secondary' ,'border','rounded-pill','px-4', 'mx-1'], 'Delete',
                            {
                                'data-user-delete' : e.user_id,
                                'href' : '/delete-user/' + e.user_id,
                            }
                        );
                        actions.append(updateButton);
                        actions.append(deleteButton);
                        tablerow.append(actions);
                    }
                    break;
                default:
                    return;
            }
            break;
    }
}
