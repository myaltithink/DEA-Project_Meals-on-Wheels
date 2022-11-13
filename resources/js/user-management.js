window.addEventListener('DOMContentLoaded', async () => {
    const entity = document.querySelector("#select-entity");
    setTable(entity, await selectEntity(entity.value));
    entity.addEventListener('change', async () => {
        /*table change here*/
        setTable(entity, await selectEntity(entity.value));
    })

});

async function selectEntity(entity){
    const attempt = await fetch('http://localhost:8000/users?selected='+ entity);
    console.log(await attempt.json());
}

function setTable(entity, data){

    const table = document.getElementById("entity-table");
    if (table.children.length != 0){
        while (table.firstChild) {
            table.removeChild(table.firstChild);
        }
    }

    switch(entity){
        case "Partner":
            /*generate partner table*/
            break;
        default:
            switch (entity){
                case "Members":
                    break;
                case "Caregivers":
                    break;
                case "Volunteers":
                    break;
                default:
                    return;
            }
            break;
    }
}
