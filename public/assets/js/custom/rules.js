// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $(".detail-rule-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/rules/${$(this).closest('.table-body').find('.rule_id').val()}`,              
        dataType: "json",
        success: function({rule}){                             
          $("#detail_title").val(rule.title)          
          $("#detail_description").val(rule.description)          
          $("#detail_score").val(rule.score)          
          // $("#detail_number_of_coaching").val(`${rule.number_of_coaching} kali`)          
        }
    })
  })

  $(".edit-rule-data").on("click", function() { 
    const rule_id = $(this).closest('.table-body').find('.rule_id').val()     
    $.ajax({
    type: "GET",
      url: `/rules/${rule_id}`,
      dataType: "json",
      success: function({rule}){            
        $("#edit-rule-form").attr("action", `/rules/${rule.id}`)        
        $("#edit_title").val(rule.title)        
        $("#edit_description").val(rule.description)        
        $("#edit_score").val(rule.score)        
        // $("#edit_number_of_coaching").val(rule.number_of_coaching)        
      }
    })
  })

  $(".delete-rule-data").on("click", function() { 
    const rule_id = $(this).closest('.table-body').find('.rule_id').val()     
    $.ajax({
      type: "GET",
      url: `/rules/${rule_id}`,
      dataType: "json",
      success: function({rule}){                   
        $("#delete_rule_form").attr("action", `/rules/${rule.id}`)
      }
    })
  })
})
