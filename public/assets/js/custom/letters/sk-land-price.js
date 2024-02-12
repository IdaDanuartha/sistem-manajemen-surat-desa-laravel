$(document).ready(function() {
    // Delete letter
    $(".btn-delete-modal").attr("disabled", true)
    $(".delete-letter-data").on("click", function() { 
      const letter_id = $(this).closest('.table-body').find('.letter_id').val()    
      $("#delete_letter_form").attr("action", `/letters/sk-land-price/${letter_id}`)

      $(".btn-delete-modal").attr("disabled", false)
    })
  })