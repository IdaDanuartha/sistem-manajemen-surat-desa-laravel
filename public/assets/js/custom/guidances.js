$(document).ready(function() {
  $('.teacher-select2').select2()
  $('.student-select2').select2()
  $('.student-rule-select2').select2()
  
  $(".student-select2").on("change", function() {      
    const path = `/guidances/${$(this).val()}/student`
    $.ajax({
        type: "GET",
        url: path,
        dataType: "json",
        success: function({restitution}){             
          const restitution_details = restitution[0].restitution_details.filter(detail => detail.status === 1)

          $(".student-rule-select2").html("")          
          if(restitution_details.length > 0) {
            restitution_details.forEach(restitution => {            
              if(restitution.status == 1) {
                $(".student-rule-select2").append(`
                  <option value="${restitution.id}">
                    ${restitution.rule.title} (${formatDate(restitution.date)})
                  </option>
                `)
              }
            })
          } else {
            $(".student-rule-select2").append(`
              <option value="">
                Tidak ada pelanggaran untuk siswa ini
              </option>
            `)
          }
        }
    })
  })
  
  // $(".detail-guidance-data").on("click", function() {  
  //   const path = `/guidances/${$(this).closest('.table-body').find('.guidance_id').val()}`        
  //   $.ajax({
  //       type: "GET",
  //       url: path,
  //       dataType: "json",
  //       success: function({guidance}){   
  //         console.log(guidance)       
  //         if(guidance.documentation_image != null) $("#detail_documentation_image").attr("src", `/uploads/guidances/documentation_images/${guidance.documentation_image}`)          
  //         console.log(guidance)
  //         $("#detail_teacher_id").val(guidance.teacher.name)
  //         $("#detail_student_id").val(guidance.student.name)          
  //         $("#detail_restitution").val(`${guidance.guidance_detail.restitution_detail.rule.title} (${formatDate(guidance.guidance_detail.restitution_detail.date)})`)
  //         $("#detail_status").val(guidance.guidance_detail.is_done ? "Sudah Tuntas" : "Belum Tuntas")          
  //         $("#detail_date").val(formatDate(guidance.date))
  //       }
  //   })
  // })

  // $(".edit-guidance-data").on("click", function() { 
  //   const path = `/guidances/${$(this).closest('.table-body').find('.guidance_id').val()}`        
  //   $.ajax({
  //   type: "GET",
  //     url: path,
  //     dataType: "json",
  //     success: function({guidance, teachers, students}){              
  //       $("#edit_guidance_form").attr("action", `/guidances/${guidance.id}`)
  //       if(guidance.user.documentation_image != null) $("#edit_documentation_image_preview").attr("src", `/uploads/guidances/documentation_images/${guidance.documentation_image}`)        
                
  //       $("#edit_date").val(showInputDate(guidance.date))
               
  //       $("#edit_teacher_id").html("")
  //       teachers.forEach(teacher => {
  //         if(teacher.id == guidance.teacher.id) {
  //           $("#edit_teacher_id").append(`
  //             <option value="${teacher.id}" selected>
  //                 ${teacher.name}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_teacher_id").append(`
  //             <option value="${teacher.id}">
  //                 ${teacher.name}
  //             </option>
  //         `)
  //         }
  //       });

  //       $("#edit_student_id").html("")
  //       students.forEach(student => {
  //         if(student.id == guidance.student.id) {
  //           $("#edit_student_id").append(`
  //             <option value="${student.id}" selected>
  //                 ${student.name}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_student_id").append(`
  //             <option value="${student.id}">
  //                 ${student.name}
  //             </option>
  //         `)
  //         }
  //       });        
  //     }
  //   })
  // })

  $(".delete-guidance-data").on("click", function() { 
    $("#delete_guidance_form").attr("action", `/guidances/${$(this).closest('.table-body').find('.guidance_id').val()}`)
  })
})

previewImg("create-guidance-input", "create-guidance-preview-img")