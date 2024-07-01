$(document).ready(function() {
    $('#creditor_office_id').on('change', function() {
        var creditorOfficeId = $(this).val();
        if (creditorOfficeId) {
            $.ajax({
                url: 'http://127.0.0.1:8000/get-amount', // Update with your route URL
                type: 'GET',
                data: { 
                    creditor_office_id: creditorOfficeId,
                    application_id: 5,
                },
                success: function(response) {
                    // Assuming the response contains the amount in a field named 'amount'
                    $('#amount').val(response.amount);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    // Handle errors here
                }
            });
        }
    });
});