jQuery(document).ready(function($) {
    // Ajax request to get projects data
    $.ajax({
        url: ajaxurl,
        method: 'GET',
        data: {
            action: 'get_projects',
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Process the project data as needed
                console.log(response.data);
            }
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
});