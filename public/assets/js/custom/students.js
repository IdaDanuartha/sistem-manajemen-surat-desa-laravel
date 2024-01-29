// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $('.student-group-select2').select2({
    dropdownParent: $("#createStudentModal")
  });
  $('.student-major-select2').select2({
    dropdownParent: $("#createStudentModal")
  });
  $('.student-generation-select2').select2({
    dropdownParent: $("#createStudentModal")
  });

  $('.edit-student-group-select2').select2({
    dropdownParent: $("#editStudentModal")
  });
  $('.edit-student-major-select2').select2({
    dropdownParent: $("#editStudentModal")
  });
  $('.edit-student-generation-select2').select2({
    dropdownParent: $("#editStudentModal")
  });

  // $(".detail-student-data").on("click", function() {
  //   $.ajax({
  //       type: "GET",
  //       url: `/students/${$(this).closest('.table-body').find('.student_id').val()}`,
  //       dataType: "json",
  //       success: function({student}){
  //         if(student.user.profile_image != null) $("#detail_profile_image").attr("src", `/uploads/users/profile_images/${student.user.profile_image}`)
  //         $("#detail_identifier_number").val(student.identifier_number)
  //         $("#detail_national_identifier_number").val(student.national_identifier_number)
  //         $("#detail_group").val(student.group.name)
  //         $("#detail_major").val(student.major.name)
  //         $("#detail_generation").val(student.generation.name)
  //         $("#detail_name").val(student.name)
  //         $("#detail_email").val(student.user.email)
  //         $("#detail_address").val(student.address)
  //         $("#detail_phone_number").val(student.phone_number)
  //         $("#detail_parent_phone").val(student.parent_phone)
  //         $("#detail_status").val(student.status)
  //         $("#detail_birth_date").val(formatDate(student.birth_date, true))
  //       }
  //   })
  // })

  // $(".edit-student-data").on("click", function() {
  //   const student_id = $(this).closest('.table-body').find('.student_id').val()
  //   $.ajax({
  //   type: "GET",
  //     url: `/students/${student_id}`,
  //     dataType: "json",
  //     success: function({student, groups, majors, generations, student_status}){
  //       $("#edit_student_form").attr("action", `/students/${student.id}`)
  //       if(student.user.profile_image != null) $("#edit_profile_image_preview").attr("src", `/uploads/users/profile_images/${student.user.profile_image}`)

  //       $("#edit_identifier_number").val(student.identifier_number)
  //       $("#edit_national_identifier_number").val(student.national_identifier_number)
  //       $("#edit_name").val(student.name)
  //       $("#edit_email").val(student.user.email)
  //       $("#edit_address").val(student.address)
  //       $("#edit_phone_number").val(student.phone_number)
  //       $("#edit_parent_phone").val(student.parent_phone)
  //       $("#edit_birth_date").val(showInputDate(student.birth_date))

  //       $("#edit_group_id").html("")
  //       groups.forEach(group => {
  //         if(group.id == student.group.id) {
  //           $("#edit_group_id").append(`
  //             <option value="${group.id}" selected>
  //                 ${group.name}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_group_id").append(`
  //             <option value="${group.id}">
  //                 ${group.name}
  //             </option>
  //         `)
  //         }
  //       });

  //       $("#edit_major_id").html("")
  //       majors.forEach(major => {
  //         if(major.id == student.major.id) {
  //           $("#edit_major_id").append(`
  //             <option value="${major.id}" selected>
  //                 ${major.name}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_major_id").append(`
  //             <option value="${major.id}">
  //                 ${major.name}
  //             </option>
  //         `)
  //         }
  //       });

  //       $("#edit_generation_id").html("")
  //       generations.forEach(generation => {
  //         if(generation.id == student.generation.id) {
  //           $("#edit_generation_id").append(`
  //             <option value="${generation.id}" selected>
  //                 ${generation.name}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_generation_id").append(`
  //             <option value="${generation.id}">
  //                 ${generation.name}
  //             </option>
  //         `)
  //         }
  //       });

  //       $("#edit_status").html("")
  //       student_status.forEach((status, i) => {
  //         if(i+1 == student.status) {
  //           $("#edit_status").append(`
  //             <option value="${i+1}" selected>
  //                 ${status}
  //             </option>
  //         `)
  //         } else {
  //           $("#edit_status").append(`
  //             <option value="${i+1}">
  //                 ${status}
  //             </option>
  //         `)
  //         }
  //       });
  //     }
  //   })
  // })

  $(".delete-student-data").on("click", function() {
    const student_id = $(this).closest('.table-body').find('.student_id').val()
    $("#delete_student_form").attr("action", `/students/${student.id}`)
  })
})

previewImg("create-student-input", "create-student-preview-img")
previewImg("edit-student-input", "edit-student-preview-img")
