$(document).ready(function() {
  $('.teacher-subject-select2').select2({
    dropdownParent: $("#createDetailScheduleModal")
  });
  $('.start-order-select2').select2({
    dropdownParent: $("#createDetailScheduleModal")
  });
  $('.end-order-select2').select2({
    dropdownParent: $("#createDetailScheduleModal")
  });

  $('.edit-start-order-select2').select2({
    dropdownParent: $("#editDetailScheduleModal")
  });
  $('.edit-end-order-select2').select2({
    dropdownParent: $("#editDetailScheduleModal")
  });
  $('.edit-teacher-subject-select2').select2({
    dropdownParent: $("#editDetailScheduleModal")
  });

  // $(".create-detail-schedule-data").on("click", function() {              
  //   const schedule_id = $(this).closest('.schedule-container').find('.schedule_id').val()         
  //   $("#create_schedule_id").val(schedule_id)
  // })

  $(".view-detail-schedule-data").on("click", function() {    
    const detail_schedule_id = $(this).closest('.table-body').find('.detail_schedule_id').val()     
    $.ajax({
      type: "GET",
      url: `/groups/${$('.group_id').val()}/schedules/${$('.schedule_id').val()}/details/${detail_schedule_id}`,
      dataType: "json",
      success: function({detail_schedule}){   
        console.log(detail_schedule)                          
        $("#detail_start_order").val(detail_schedule.start_order)
        $("#detail_end_order").val(detail_schedule.end_order)
        $("#detail_start_time").val(formatTime(detail_schedule.start_time))        
        $("#detail_end_time").val(formatTime(detail_schedule.end_time))               
        $("#detail_subject_teacher_id").val(`${detail_schedule.subject_teacher.subject.name} - ${detail_schedule.subject_teacher.teacher.name}`)
      }
    })
  })
  const day = $('.schedule_day').val() == 1 ? 1 : $('.schedule_day').val() > 1 && $('.schedule_day').val() < 6 ? 2 : 3   

  $(".start-order-select2").on("change", function() {    
    $.ajax({
      type: "GET",
      url: `/get-time?start_order=${$(this).val()}&end_order=${$('.end-order-select2').val()}&day=${day}`,
      dataType: "json",
      success: function({get_start_end_time}){                     
        $('#start_time').val(get_start_end_time[0])
        $('#end_time').val(get_start_end_time[1])
      }
    })
  })

  $(".end-order-select2").on("change", function() {        
    $.ajax({
      type: "GET",
      url: `/get-time?start_order=${$('.start-order-select2').val()}&end_order=${$(this).val()}&day=${day}`,
      dataType: "json",
      success: function({get_start_end_time}){                     
        $('#start_time').val(get_start_end_time[0])
        $('#end_time').val(get_start_end_time[1])
      }
    })
  })

  $(".edit-start-order-select2").on("change", function() {        
    $.ajax({
      type: "GET",
      url: `/get-time?start_order=${$(this).val()}&end_order=${$('.edit-end-order-select2').val()}&day=${day}`,
      dataType: "json",
      success: function({get_start_end_time}){                     
        $('#edit_start_time').val(get_start_end_time[0])
        $('#edit_end_time').val(get_start_end_time[1])
      }
    })
  })

  $(".edit-end-order-select2").on("change", function() {        
    $.ajax({
      type: "GET",
      url: `/get-time?start_order=${$('.edit-start-order-select2').val()}&end_order=${$(this).val()}&day=${day}`,
      dataType: "json",
      success: function({get_start_end_time}){                     
        $('#edit_start_time').val(get_start_end_time[0])
        $('#edit_end_time').val(get_start_end_time[1])
      }
    })
  })

  $(".edit-detail-schedule-data").on("click", function() {    
    const detail_schedule_id = $(this).closest('.table-body').find('.detail_schedule_id').val()     
    $.ajax({
      type: "GET",
      url: `/groups/${$('.group_id').val()}/schedules/${$('.schedule_id').val()}/details/${detail_schedule_id}`,
      dataType: "json",
    success: function({detail_schedule, subject_teachers, get_list_schedules}){                             
        $("#edit_detail_schedule_form").attr("action", `/groups/${$('.group_id').val()}/schedules/${$('.schedule_id').val()}/details/${detail_schedule_id}`)                
        $("#edit_start_time").val(formatTime(detail_schedule.start_time, true))
        $("#edit_end_time").val(formatTime(detail_schedule.end_time, true))

        $("#edit_subject_teacher_id").html("")
        
        subject_teachers.forEach(subject_teacher => {
          if(subject_teacher.id == detail_schedule.subject_teacher_id) {
            $("#edit_subject_teacher_id").append(`
              <option value="${subject_teacher.id}" selected>
                  ${subject_teacher.subject.name} - ${subject_teacher.teacher.name}
              </option>
          `)
          } else {
            $("#edit_subject_teacher_id").append(`
              <option value="${subject_teacher.id}">
                  ${subject_teacher.subject.name} - ${subject_teacher.teacher.name}
              </option>
          `)
          }
        });  
        
        get_list_schedules.forEach((schedule, index) => {
          if(index+1 == detail_schedule.start_order) {
            $("#edit_start_order").append(`
              <option value="${index+1}" selected>
                Jam ke-${index+1} (${schedule[0]} - ${schedule[1]})
              </option>
          `)
          } else {
            $("#edit_start_order").append(`
              <option value="${index+1}">
                Jam ke-${index+1} (${schedule[0]} - ${schedule[1]})
              </option>
          `)
          }

          if(index+1 == detail_schedule.end_order) {
            $("#edit_end_order").append(`
              <option value="${index+1}" selected>
                Jam ke-${index+1} (${schedule[0]} - ${schedule[1]})
              </option>
          `)
          } else {
            $("#edit_end_order").append(`
              <option value="${index+1}">
                Jam ke-${index+1} (${schedule[0]} - ${schedule[1]})
              </option>
          `)
          }
        });  
      }
    })
  })

  $(".delete-detail-schedule-data").on("click", function() {       
    const detail_schedule_id = $(this).closest('.table-body').find('.detail_schedule_id').val()       
    $.ajax({
      type: "GET",
      url: `/groups/${$('.group_id').val()}/schedules/${$('.schedule_id').val()}/details/${detail_schedule_id}`,
      dataType: "json",
      success: function({detail_schedule}){                 
        $("#delete_detail_schedule_form").attr("action", `/groups/${$('.group_id').val()}/schedules/${$('.schedule_id').val()}/details/${detail_schedule_id}`)
      }
    })
  })
})
