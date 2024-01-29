// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $('.major-select2').select2({
    dropdownParent: $("#createGroupModal")
  });

  $('.edit-major-select2').select2({
    dropdownParent: $("#editGroupModal")
  });

  $(".edit-group-data").on("click", function() { 
    const group_id = $(this).closest('.table-body').find('.group_id').val()         
    $.ajax({
    type: "GET",
      url: `/groups/${group_id}`,
      dataType: "json",
      success: function({group, majors}){
        console.log(majors)
        $("#edit-group-form").attr("action", `/groups/${group.id}`)        
        $("#edit_name").val(group.name)        
        
        $("#edit_major_id").html("")
        majors.forEach(major => {
          if(major.id == group.major_id) {
            $("#edit_major_id").append(`
              <option value="${major.id}" selected>
                  ${major.name} (${major.generation.name})
              </option>
          `)
          } else {
            $("#edit_major_id").append(`
              <option value="${major.id}">
                  ${major.name} (${major.generation.name})
              </option>
          `)
          }
        });
      }
    })
  })

  $(".delete-group-data").on("click", function() { 
    const group_id = $(this).closest('.table-body').find('.group_id').val()         
    $.ajax({
      type: "GET",
      url: `/groups/${group_id}`,
      dataType: "json",
      success: function({group}){
        $("#delete_group_form").attr("action", `/groups/${group.id}`)
      }
    })
  })
})
