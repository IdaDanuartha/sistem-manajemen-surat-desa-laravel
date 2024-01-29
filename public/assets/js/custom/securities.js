$(document).ready(function() {
  $(".detail-security-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/securities/${$(this).closest('.table-body').find('.security_id').val()}`,              
        dataType: "json",
        success: function({security}){          
          if(security.user.profile_image != null) $("#detail-profile-image").attr("src", `/uploads/users/profile_images/${security.user.profile_image}`)
          $("#detail-code").val(security.code)
          $("#detail-name").val(security.name)
          $("#detail-email").val(security.user.email)
          $("#detail-address").val(security.address)
          $("#detail-phone-number").val(security.phone_number)     
        }
    })
  })

  $(".edit-security-data").on("click", function() { 
    const security_id = $(this).closest('.table-body').find('.security_id').val()     
    $.ajax({
    type: "GET",
      url: `/securities/${security_id}`,
      dataType: "json",
      success: function({security}){            
        $("#edit-security-form").attr("action", `/securities/${security.id}`)
        if(security.user.profile_image != null) $("#edit-profile-image-preview").attr("src", `/uploads/users/profile_images/${security.user.profile_image}`)        
        $("#edit-code").val(security.code)
        $("#edit-name").val(security.name)
        $("#edit-email").val(security.user.email)
        $("#edit-address").val(security.address)
        $("#edit-phone-number").val(security.phone_number)
      }
    })
  })

  $(".delete-security-data").on("click", function() { 
    const security_id = $(this).closest('.table-body').find('.security_id').val()     
    $.ajax({
      type: "GET",
      url: `/securities/${security_id}`,
      dataType: "json",
      success: function({security}){                   
        $("#delete_security_form").attr("action", `/securities/${security.id}`)
      }
    })
  })
})

previewImg("create-security-input", "create-security-preview-img")
previewImg("edit-security-input", "edit-security-preview-img")