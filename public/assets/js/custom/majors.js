$(document).ready(function() {
  $('.generation-select2').select2({
    dropdownParent: $("#createMajorModal")
  });

  $('.edit-generation-select2').select2({
    dropdownParent: $("#editMajorModal")
  });

  $(".detail-major-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/majors/${$(this).closest('.table-body').find('.major_id').val()}`,              
        dataType: "json",
        success: function({major}){                             
          $("#detail_name").val(major.name)          
          $("#detail_generation_id").val(major.generation.name)
        }
    })
  })

  $(".edit-major-data").on("click", function() { 
    const major_id = $(this).closest('.table-body').find('.major_id').val()     
    $.ajax({
    type: "GET",
      url: `/majors/${major_id}`,
      dataType: "json",
      success: function({major, generations}){            
        $("#edit-major-form").attr("action", `/majors/${major.id}`)        
        $("#edit_name").val(major.name)
        
        $("#edit_generation_id").html("")
        
        generations.forEach(generation => {
          if(generation.id == major.generation.id) {
            $("#edit_generation_id").append(`
              <option value="${generation.id}" selected>
                  ${generation.name}
              </option>
          `)
          } else {
            $("#edit_generation_id").append(`
              <option value="${generation.id}">
                  ${generation.name}
              </option>
          `)
          }
        });
      }
    })
  })

  $(".delete-major-data").on("click", function() { 
    const major_id = $(this).closest('.table-body').find('.major_id').val()     
    $.ajax({
      type: "GET",
      url: `/majors/${major_id}`,
      dataType: "json",
      success: function({major}){                   
        $("#delete_major_form").attr("action", `/majors/${major.id}`)
      }
    })
  })
})
