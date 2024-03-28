$(document).ready(function() {
    // Delete environmental
    $(".btn-delete-modal").attr("disabled", true)
    $(".delete-environmental-data").on("click", function() { 
      const environmental_id = $(this).closest('.table-body').find('.environmental_id').val()    
      $("#delete_environmental_form").attr("action", `/environmentals/${environmental_id}`)

      $(".btn-delete-modal").attr("disabled", false)
    })
  })