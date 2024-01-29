// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $('.student-select2').select2({
    dropdownParent: $("#createUnderprevilegeModal")
  });

  $('.edit-student-select2').select2({
    dropdownParent: $("#editUnderprevilegeModal")
  });

  $(".detail-underprevilege-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/underprivileged/${$(this).closest('.table-body').find('.underprevilege_id').val()}`,              
        dataType: "json",
        success: function({underprivileged_students}){   
          const underprevilege = underprivileged_students          

          $("#detail_description").val(underprevilege.description)    
          $("#detail_student").val(underprevilege.student.name)
          $("#detail_filename").html(underprevilege.filename)
          $("#detail_filename").attr("href", `/uploads/underprevileges/${underprevilege.filename}`)
        }
    })
  })

  $(".edit-underprevilege-data").on("click", function() { 
    const underprevilege_id = $(this).closest('.table-body').find('.underprevilege_id').val()     
    $.ajax({
    type: "GET",
      url: `/underprivileged/${underprevilege_id}`,
      dataType: "json",
      success: function({underprivileged_students, students}){ 
        const underprevilege = underprivileged_students
           
        $("#edit-underprevilege-form").attr("action", `/underprivileged/${underprevilege.id}`)                
        $("#edit_description").val(underprevilege.description) 

        $("#edit_student_id").html("")
        students.forEach(student => {
          if(student.id == underprevilege.student_id) {
            $("#edit_student_id").append(`
              <option value="${student.id}" selected>
                  ${student.name}
              </option>
          `)
          } else {
            $("#edit_student_id").append(`
              <option value="${student.id}">
                  ${student.name}
              </option>
          `)
          }
        });
      }
    })
  })

  $(".delete-underprevilege-data").on("click", function() { 
    const underprevilege_id = $(this).closest('.table-body').find('.underprevilege_id').val()     
    $.ajax({
      type: "GET",
      url: `/underprivileged/${underprevilege_id}`,
      dataType: "json",
      success: function({underprivileged_students}){    
        const underprevilege = underprivileged_students
               
        $("#delete_underprevilege_form").attr("action", `/underprivileged/${underprevilege.id}`)
      }
    })
  })
})