$(document).ready(function() {
  $(".detail-subject-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/subjects/${$(this).closest('.table-body').find('.subject_id').val()}`,              
        dataType: "json",
        success: function({subject}){                             
          $("#detail_name").val(subject.name)          
          $("#detail_code").val(subject.code)          
        }
    })
  })

  $(".edit-subject-data").on("click", function() { 
    const subject_id = $(this).closest('.table-body').find('.subject_id').val()     
    $.ajax({
    type: "GET",
      url: `/subjects/${subject_id}`,
      dataType: "json",
      success: function({subject}){            
        $("#edit-subject-form").attr("action", `/subjects/${subject.id}`)        
        $("#edit_code").val(subject.code)        
        $("#edit_name").val(subject.name)        
      }
    })
  })

  $(".delete-subject-data").on("click", function() { 
    const subject_id = $(this).closest('.table-body').find('.subject_id').val()     
    $.ajax({
      type: "GET",
      url: `/subjects/${subject_id}`,
      dataType: "json",
      success: function({subject}){                   
        $("#delete_subject_form").attr("action", `/subjects/${subject.id}`)
      }
    })
  })
})
