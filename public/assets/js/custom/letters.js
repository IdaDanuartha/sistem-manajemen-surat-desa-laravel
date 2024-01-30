$(document).ready(function() {
  // Delete letter
  $(".delete-letter-data").on("click", function() { 
    const letter_id = $(this).closest('.table-body').find('.letter_id').val()    
    $("#delete_letter_form").attr("action", `/letters/${letter_id}`)
  })
})