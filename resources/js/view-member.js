
import 'bootstrap/dist/js/bootstrap';

$('#view-member').on('click', () => {
    $('#member-details').modal('show');
});

$('#hide-member').on('click', () => {
    $('#member-details').modal('hide');
})
