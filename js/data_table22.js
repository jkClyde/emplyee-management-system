$(document).ready(function () {
  let dataTable = $("#dataTable").DataTable({
    ajax: {
      url: "./php/server.php",
      type: "POST",
    },
    columns: [
      // column showing img_url as image
      {
        data: "image_url",
        render: function (data, type, row) {
          return (
            '<div style="display: flex; justify-content: center;">' +
            '<img src="php/uploads/' +
            data +
            '" alt="Employee Image" style="max-width: 60px; max-height: 60px;">' +
            "</div>"
          );
        },
      },

      { data: "name" },
      { data: "position" },
      { data: "age" },
      { data: "designation" },
      { data: "start_date" },
      { data: "salary" },
      {
        data: null,
        render: function (data, type, row) {
          return (
            '<div class="d-flex justify-content-around">' +
            '<button class="btn btn-primary btn-sm edit-btn" data-toggle="tooltip" title="Edit" data-id="' +
            data.id +
            '"><i class="fas fa-edit"></i></button>' +
            '<button class="btn btn-danger btn-sm delete-btn" data-toggle="tooltip" title="Delete" data-id="' +
            data.id +
            '"><i class="fas fa-trash-alt"></i></button>' +
            "</div>"
          );
        },
      },
    ],
    processing: true,
    serverSide: true,
    ordering: true,
  });

  // $("#dataTable tbody").css("vertical-align", "center");

  // Reload the table data when needed
  function reloadData() {
    dataTable.ajax.reload();
  }

  // CREATE ==================================================================================================================
  $("#addEmployeeForm").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "php/add_employee.php",
      type: "POST",
      data: formData,
      processData: false, // Important: Prevent jQuery from processing the data
      contentType: false, // Important: Don't set a default content-type
      success: function (response) {
        if (response.success) {
          var successMessage = response.message;
          reloadData();
          $("#addEmployeeModal").modal("hide");
          $("#success-notification").html(successMessage);
          $("#success-notification").show().delay(10000).fadeOut();

          // Use SweetAlert for success message
          Swal.fire({
            icon: "success",
            title: "Employee Added Successfully!",
            text: successMessage,
            timer: 5000,
            showConfirmButton: true,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Error: " + response.message,
            showConfirmButton: true,
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        var errorMessage = jqXHR.responseText;
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Error: " + errorMessage,
          showConfirmButton: true,
        });
      },
    });
  });

  // UPDATE ==================================================================================================================
  $("#editEmployeeForm").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "php/edit_employee.php",
      type: "POST",
      data: formData,
      processData: false, // Important: Prevent jQuery from processing the data
      contentType: false, // Important: Don't set a default content-type
      dataType: "json", // Parse response as JSON
      success: function (response) {
        console.log(response);
        if (response.success) {
          reloadData();
          $("#editEmployeeModal").modal("hide");
          // Use SweetAlert for success message
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: "Successful Edit!",
            timer: 5000,
            showConfirmButton: true,
          });
        }
      },
      error: function (xhr, status, error) {
        alert("Error submitting the form: " + error);
      },
    });
  });

  // Delete ================================================================================================================
  $("#dataTable").on("click", ".delete-btn", function (e) {
    var employeeId = $(this).data("id");

    // Trigger the modal
    $("#deleteEmployeeModal").modal("show");

    $("#confirmDeleteBtn").on("click", function () {
      $.ajax({
        url: "php/delete_employee.php",
        type: "POST",
        data: { delete_id: employeeId },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            reloadData();
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: "Employee deleted successfully!",
              timer: 5000,
              showConfirmButton: true,
            });
            $("#deleteEmployeeModal").modal("hide");
          } else {
            alert("Error deleting employee: " + response.message);
          }
        },
        error: function (xhr, status, error) {
          alert("Error deleting employee: " + error);
        },
      });
    });
  });
});
