$(document).ready(function() {
  $('.grade-select2').select2({
    dropdownParent: $("#createGenerationModal")
  });

  $('.edit-grade-select2').select2({
    dropdownParent: $("#editGenerationModal")
  });

  $(".detail-generation-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/generations/${$(this).closest('.table-body').find('.generation_id').val()}`,              
        dataType: "json",
        success: function({generation}){                             
          $("#detail_name").val(generation.name)          
          $("#detail_year").val(generation.year)          
          $("#detail_grade").val(generation.grade == 1 ? 'X' : generation.grade == 2 ? 'XI' : generation.grade == 3 ? 'XII' : '')
        }
    })
  })

  $(".edit-generation-data").on("click", function() { 
    const generation_id = $(this).closest('.table-body').find('.generation_id').val()     
    $.ajax({
    type: "GET",
      url: `/generations/${generation_id}`,
      dataType: "json",
      success: function({generation, grades}){            
        $("#edit-generation-form").attr("action", `/generations/${generation.id}`)        
        $("#edit_name").val(generation.name)        
        $("#edit_year").val(generation.year)  
        
        $("#edit_grade").html("")
        console.log(grades)
        grades.forEach((grade, index) => {
          if(index+1 == generation.grade) {
            $("#edit_grade").append(`
              <option value="${index+1}" selected>
                  ${grade}
              </option>
          `)
          } else {
            $("#edit_grade").append(`
              <option value="${index+1}">
                  ${grade}
              </option>
          `)
          }
        });
      }
    })
  })

  $(".delete-generation-data").on("click", function() { 
    const generation_id = $(this).closest('.table-body').find('.generation_id').val()     
    $.ajax({
      type: "GET",
      url: `/generations/${generation_id}`,
      dataType: "json",
      success: function({generation}){                   
        $("#delete_generation_form").attr("action", `/generations/${generation.id}`)
      }
    })
  })
})