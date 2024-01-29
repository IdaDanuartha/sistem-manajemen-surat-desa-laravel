// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $('.student-select2').select2({
    dropdownParent: $("#createRestitutionModal")
  });
  $('.rule-select2').select2({
    dropdownParent: $("#createRestitutionModal")
  });
  $('.status-select2').select2({
    dropdownParent: $("#createRestitutionModal")
  });

  $(".detail-restitution-data").on("click", function() {   
    $.ajax({
      type: "GET",
        url: `/restitutions/${$(this).closest('.table-body').find('.restitution_id').val()}`,              
        dataType: "json",
        success: function({restitution}){                                 
          $("#detail_student").val(restitution.student.name)          
          $("#detail_total_score").val(restitution.total_score)

          const restitution_details = restitution.restitution_details
          console.log(restitution_details)

          $("#detail_rule").html("")
          restitution_details.forEach(detail => {            
            $("#detail_rule").append(`
              <div class="col-4 mb-3">                
                <input
                  type="text"              
                  class="form-control"
                  value="${detail.rule.title}"              
                  readonly/>
              </div>
              <div class="col-2 mb-3">                
                <input
                  type="text"
                  class="form-control"
                  value="${detail.rule.score}"              
                  readonly/>
              </div>
              <div class="col-3 mb-3">                
                <input
                  type="text"
                  class="form-control"
                  value="${detail.status == 1 ? 'Active':'Inactive'}"              
                  readonly/>
              </div>
              <div class="col-3 mb-3">                
                <input
                  type="text"
                  class="form-control"
                  value="${formatDate(detail.date)}"              
                  readonly/>
              </div>
            `)
          });
        }
    })
  })

  $(".edit-restitution-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/restitutions/${$(this).closest('.table-body').find('.restitution_id').val()}`,              
        dataType: "json",
        success: function({restitution}){    
          $("#edit-restitution-form").attr("action", `/restitutions/${restitution.id}`)        
                        
          const restitution_details = restitution.restitution_details          

          $("#edit_rule").html("")
          restitution_details.forEach(detail => {            
            $("#edit_rule").append(`
              <div class="row">
                <div class="col-3 mb-3">                
                  <input
                    type="text"              
                    class="form-control"
                    value="${detail.rule.title}"              
                    readonly/>
                </div>
                <div class="col-2 mb-3">                
                  <input
                    type="text"
                    class="form-control"
                    value="${detail.rule.score}"              
                    readonly/>
                </div>
                <div class="col-2 mb-3">   
                  <input
                  type="text"
                  class="form-control"
                  value="${detail.status == 1 ? 'Active' : 'Inactive'}"              
                  readonly/>
                </div>
                <div class="col-3 mb-3">                
                  <input
                    type="text"
                    class="form-control"
                    value="${formatDate(detail.date)}"              
                    readonly/>
                </div>
                <div class="col-1 mb-3">   
                  <button type="button" class="btn btn-danger btn-restitution-delete" data-id="${detail.id}">Delete</button>
                </div>
              </div>
            `)
          });

          $(".btn-restitution-delete").on('click', function() {
            $(this).parent().parent().remove()
  
            let oldValue = $(".restitution_deleted").val()            
            let arr = oldValue === "" ? [] : oldValue.split(',');
            arr.push($(this).data('id'));
            let newValue = arr.join(',');
  
            $(".restitution_deleted").val(newValue)
  
            console.log($(".restitution_deleted").val())
          })
        }
    })
  })

  $(".delete-restitution-data").on("click", function() { 
    const restitution_id = $(this).closest('.table-body').find('.restitution_id').val()     
    $.ajax({
      type: "GET",
      url: `/restitutions/${restitution_id}`,
      dataType: "json",
      success: function({restitution}){           
        $("#delete_restitution_form").attr("action", `/restitutions/${restitution.id}`)
      }
    })
  })
})