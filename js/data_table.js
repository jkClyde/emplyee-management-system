$(document).ready(function() {
    let dataTable = $('#dataTable').DataTable({
      ajax: {
          url: './php/server.php',
          type: 'POST'
      },
      columns: [
          { data: 'name' },
          { data: 'position' },
          { data: 'age' },
          { data: 'start_date' },
          { data: 'salary' },
          {
            data: null,
            render: function(data, type, row) {
                // This function will be called for each row in the DataTable
                // You can return HTML content here for the Actions column
                return '<div class="d-flex justify-content-around">' + 
                '<button class="btn btn-info btn-sm view-btn" data-toggle="tooltip" title="View" data-id="' + data.id + '"><i class="fas fa-eye"></i></button>' +

                '<button class="btn btn-primary btn-sm edit-btn" data-toggle="tooltip" title="Edit" data-id="' + data.id + '"><i class="fas fa-edit"></i></button>' +
                '<button class="btn btn-danger btn-sm delete-btn" data-toggle="tooltip" title="Delete" data-id="' + data.id + '"><i class="fas fa-trash-alt"></i></button>' +
            '</div>';
    
    
            }
        }
      ],
      processing: true,
      serverSide: true,
      ordering: true,
  });
  
  // Reload the table data when needed
  function reloadData() {
    dataTable.ajax.reload();
  }


  // CREATE ==================================================================================================================
  $('#addEmployeeForm').on('submit', function(e) {
    e.preventDefault(); 

    $.ajax({
        url: 'php/add_employee.php', 
        type: 'POST',
        data: $(this).serialize(), 
        success: function(response) {
            if (response.success) {
                var successMessage = response.message;
                reloadData();
                $('#addEmployeeModal').modal('hide');
                $('#success-notification').html(successMessage);
                $('#success-notification').show().delay(10000).fadeOut(); 

                // Use SweetAlert for success message
                Swal.fire({
                    icon: 'success',
                    title: 'Employee Added Successfully!',
                    text: successMessage,
                    timer: 5000,
                    showConfirmButton: true
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: ' + response.message,
                    showConfirmButton: true
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var errorMessage = jqXHR.responseText 
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + errorMessage,
                showConfirmButton: true
            });
        }
    });
});



   // UPDATE ==================================================================================================================
   $('#editEmployeeForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'php/edit_employee.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                reloadData()
                $('#editEmployeeModal').modal('hide');
                 // Use SweetAlert for success message
                 Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: "Successful Edit!",
                  timer: 5000,
                  showConfirmButton: true
              });
           
                // Reload the table or update the row with the edited data
            } else {
                alert('Error updating employee: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error submitting the form: ' + error);
        }
    });
});


// Delete ================================================================================================================
$('#dataTable').on('click', '.delete-btn', function(e) {
  var employeeId = $(this).data('id');

   // Trigger the modal
    $('#deleteEmployeeModal').modal('show');

    $('#confirmDeleteBtn').on('click', function() {
        $.ajax({
            url: 'php/delete_employee.php',
            type: 'POST',
            data: { delete_id: employeeId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    reloadData();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Employee deleted successfully!',
                        timer: 5000,
                        showConfirmButton: true
                    });
                    $('#deleteEmployeeModal').modal('hide');
                } else {
                    alert('Error deleting employee: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting employee: ' + error);
            }
        });
    });
});
});
  
  
  
    