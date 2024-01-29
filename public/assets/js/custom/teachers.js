// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $(".delete-teacher-data").on("click", function() {
    const teacher_id = $(this).closest('.table-body').find('.teacher_id').val()
    $.ajax({
      type: "GET",
      url: `/teachers/${teacher_id}`,
      dataType: "json",
      success: function({teacher}){
        $("#delete_teacher_form").attr("action", `/teachers/${teacher.id}`)
      }
    })
  })
})

previewImg("create-teacher-input", "create-teacher-preview-img")
previewImg("edit-teacher-input", "edit-teacher-preview-img")
